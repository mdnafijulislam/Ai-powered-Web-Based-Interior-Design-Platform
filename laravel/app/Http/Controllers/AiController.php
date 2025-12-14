<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\WorkerPortfolio;

class AiController extends Controller
{
    public function form()
    {
        return view('ai.form');
    }

    public function saveResult(Request $request)
    {
        $request->validate([
            'final_image'    => 'required|string',
            'original_image' => 'required|string',
            'prompt'         => 'required|string',
        ]);

        // Save original image
        $original = base64_decode(
            preg_replace('#^data:image/\w+;base64,#i', '', $request->original_image)
        );

        $originalPath = 'ai_inputs/' . time() . '_original.png';
        Storage::disk('public')->put($originalPath, $original);

        // Save AI image
        $generated = base64_decode(
            preg_replace('#^data:image/\w+;base64,#i', '', $request->final_image)
        );

        $generatedPath = 'ai_outputs/' . time() . '_ai.png';
        Storage::disk('public')->put($generatedPath, $generated);

        session([
            'ai_original_image'  => $originalPath,
            'ai_generated_image' => $generatedPath,
            'ai_prompt'          => $request->prompt,
        ]);

        return response()->json(['success' => true]);
    }

    public function result()
    {
        $originalPath  = session('ai_original_image');
        $generatedPath = session('ai_generated_image');
        $prompt        = session('ai_prompt');

        if (!$originalPath || !$generatedPath) {
            return redirect()->route('ai.form');
        }

        // 🔥 REAL designers with portfolio
        $workers = WorkerPortfolio::with('user')
            ->latest()
            ->take(6)
            ->get();

        return view('ai.result', [
            'originalImage'  => asset('storage/' . $originalPath),
            'generatedImage' => asset('storage/' . $generatedPath),
            'prompt'         => $prompt,
            'workers'        => $workers,
        ]);
    }
}
