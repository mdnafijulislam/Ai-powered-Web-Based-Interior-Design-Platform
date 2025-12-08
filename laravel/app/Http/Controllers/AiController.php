<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\WorkerPortfolio;
use OpenAI\Laravel\Facades\OpenAI;

class AiController extends Controller
{
    public function form()
    {
        return view('ai.form');
    }

    // -------------------------------
    // SAVE AI IMAGE (from browser)
    // -------------------------------
    public function saveResult(Request $request)
    {
        $request->validate([
            'final_image' => 'required|string',
            'prompt'      => 'required|string',
        ]);

        // Convert base64 → PNG
        $img = base64_decode($request->final_image);

        $path = 'ai_outputs/' . time() . '_ai.png';
        Storage::disk('public')->put($path, $img);

        session([
            'ai_result_image' => $path,
            'ai_prompt' => $request->prompt,
        ]);

        return response()->json(['status' => 'saved']);
    }

    // -------------------------------
    // RESULT PAGE + WORKER MATCHING
    // -------------------------------
    public function result()
    {
        $imagePath = session('ai_result_image');
        $prompt    = session('ai_prompt');

        if (!$imagePath) {
            return redirect()->route('ai.form')
                ->with('error', 'No AI result found.');
        }

        // Worker matching using OpenAI
        $analysis = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'Extract interior design keywords.'],
                ['role' => 'user', 'content' => $prompt]
            ]
        ]);

        $keywords = explode(',', strtolower($analysis->choices[0]->message->content));

        $workers = WorkerPortfolio::where(function ($q) use ($keywords) {
            foreach ($keywords as $k) {
                $q->orWhere('type', 'LIKE', "%$k%")
                  ->orWhere('tags', 'LIKE', "%$k%");
            }
        })->with('user')->get();

        return view('ai.result', [
            'generatedImage' => asset("storage/" . $imagePath),
            'prompt'         => $prompt,
            'workers'        => $workers,
        ]);
    }
}
