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

        $originalPath  = 'ai_inputs/' . time() . '_original.png';
        $generatedPath = 'ai_outputs/' . time() . '_ai.png';

        Storage::disk('public')->put(
            $originalPath,
            base64_decode($request->original_image)
        );

        Storage::disk('public')->put(
            $generatedPath,
            base64_decode($request->final_image)
        );

        session([
            'ai_original_image'  => $originalPath,
            'ai_generated_image' => $generatedPath,
            'ai_prompt'          => $request->prompt,
        ]);

        return response()->json(['status' => 'saved']);
    }

    public function result()
    {
        $originalPath  = session('ai_original_image');
        $generatedPath = session('ai_generated_image');
        $prompt        = session('ai_prompt');

        if (!$originalPath || !$generatedPath) {
            return redirect()->route('ai.form')
                ->with('error', 'No AI result found.');
        }

        $workers = WorkerPortfolio::latest()->take(4)->get();

        return view('ai.result', [
            'originalImage'  => asset('storage/' . $originalPath),
            'generatedImage' => asset('storage/' . $generatedPath),
            'prompt'         => $prompt,
            'workers'        => $workers,
        ]);
    }
}
