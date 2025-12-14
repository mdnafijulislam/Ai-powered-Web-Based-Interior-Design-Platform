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
       SAVE AI RESULT (SAVE PATH FIX)
       Images → storage/app/public/
    ============================ */
    public function saveResult(Request $request)
    {
        $request->validate([
            'original_image' => 'required|string',
            'final_image'    => 'required|string',
            'prompt'         => 'required|string',
        ]);

        // 🔐 Extract pure base64 safely
        try {
            $originalBase64  = explode(',', $request->original_image)[1];
            $generatedBase64 = explode(',', $request->final_image)[1];
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid image data'
            ], 422);
        }

        // ⏱ Unique filenames
        $time = time();

        // ✅ FINAL SAVE PATH (STANDARD)
        $originalPath  = "ai_inputs/{$time}_original.png";
        $generatedPath = "ai_outputs/{$time}_ai.png";

        // 💾 Save images
        Storage::disk('public')->put($originalPath, base64_decode($originalBase64));
        Storage::disk('public')->put($generatedPath, base64_decode($generatedBase64));

        // 🧠 Store paths + prompt in session
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
       GEMINI AI TEXT ANALYSIS
    ============================ */
    public function geminiAnalyze(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        try {
            $response = Http::timeout(25)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post(
                    "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=" . config('services.gemini.key'),
                    [
                        "contents" => [
                            [
                                "parts" => [
                                    [
                                        "text" =>
                                            "Analyze the interior design request below and respond clearly with bullet points:\n\n" .
                                            "• Room type\n" .
                                            "• Suggested color palette\n" .
                                            "• Furniture to add\n" .
                                            "• Furniture to remove\n" .
                                            "• Lighting recommendation\n\n" .
                                            "User request: " . $request->prompt
                                    ]
                                ]
                            ]
                        ]
                    ]
                );

            $analysis = data_get(
                $response->json(),
                'candidates.0.content.parts.0.text',
                'No analysis available at the moment.'
            );

        } catch (\Exception $e) {
            $analysis = '⚠️ Gemini analysis failed. Please try again later.';
        }

        return response()->json([
            'analysis' => $analysis
        ]);
    }

    /* ============================
       SHOW AI RESULT PAGE
       (URL FIX USING Storage::url)
    ============================ */
    public function result()
    {
        $originalPath  = session('ai_original_image');
        $generatedPath = session('ai_generated_image');
        $prompt        = session('ai_prompt');

        if (!$originalPath || !$generatedPath) {
            return redirect()
                ->route('ai.form')
                ->with('error', 'No AI result found. Please try again.');
        }

        // 👷 Recommended designers
        $workers = WorkerPortfolio::with('user')
            ->latest()
            ->take(6)
            ->get();

        return view('ai.result', [
            // ✅ FINAL URL FIX
            'originalImage'  => Storage::url($originalPath),
            'generatedImage' => Storage::url($generatedPath),
            'prompt'         => $prompt,
            'workers'        => $workers,
        ]);
    }
}
