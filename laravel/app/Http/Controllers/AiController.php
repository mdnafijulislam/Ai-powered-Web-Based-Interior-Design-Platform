<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\WorkerPortfolio;

class AiController extends Controller
{
    /* ============================
       SHOW AI FORM
    ============================ */
    public function form()
    {
        return view('ai.form');
    }


    /* ============================
       SAVE AI RESULT (MOCK / IMAGE)
    ============================ */
    public function saveResult(Request $request)
    {
        $request->validate([
            'final_image'    => 'required|string',
            'original_image' => 'required|string',
            'prompt'         => 'required|string',
        ]);

        // Remove base64 headers safely
        $originalBase64  = preg_replace('#^data:image/\w+;base64,#i', '', $request->original_image);
        $generatedBase64 = preg_replace('#^data:image/\w+;base64,#i', '', $request->final_image);

        // Save original image
        $originalPath = 'ai_inputs/' . time() . '_original.png';
        Storage::disk('public')->put($originalPath, base64_decode($originalBase64));

        // Save generated image
        $generatedPath = 'ai_outputs/' . time() . '_ai.png';
        Storage::disk('public')->put($generatedPath, base64_decode($generatedBase64));

        // Store paths + prompt in session
        session([
            'ai_original_image'  => $originalPath,
            'ai_generated_image' => $generatedPath,
            'ai_prompt'          => $request->prompt,
        ]);

        return response()->json([
            'success' => true
        ]);
    }


    /* ============================
       STEP-5 : GEMINI ANALYSIS
       (TEXT-ONLY, STABLE)
    ============================ */
    public function geminiAnalyze(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        try {
            $response = Http::timeout(20)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . env('GEMINI_API_KEY'),
                [
                    "contents" => [
                        [
                            "parts" => [
                                [
                                    "text" =>
                                        "Analyze the following interior design request and respond clearly with:
                                        1. Room type
                                        2. Color palette suggestion
                                        3. Furniture to add
                                        4. Furniture to remove
                                        5. Lighting recommendation

                                        User request: " . $request->prompt
                                ]
                            ]
                        ]
                    ]
                ]
            );

            $analysis =
                $response->json()['candidates'][0]['content']['parts'][0]['text']
                ?? 'No analysis available at the moment.';

        } catch (\Exception $e) {
            $analysis = 'AI analysis failed. Please try again later.';
        }

        return response()->json([
            'analysis' => $analysis
        ]);
    }


    /* ============================
       SHOW RESULT PAGE
    ============================ */
    public function result()
    {
        $originalPath  = session('ai_original_image');
        $generatedPath = session('ai_generated_image');
        $prompt        = session('ai_prompt');

        if (!$originalPath || !$generatedPath) {
            return redirect()->route('ai.form')
                ->with('error', 'No AI result found. Please try again.');
        }

        // ✅ Designers with portfolio + user
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
