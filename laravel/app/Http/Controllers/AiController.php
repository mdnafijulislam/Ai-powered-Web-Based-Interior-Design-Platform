<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\WorkerPortfolio;
use OpenAI\Laravel\Facades\OpenAI;
use GuzzleHttp\Client;

class AiController extends Controller
{
    public function form()
    {
        return view('ai.form');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'room_image' => 'required|image',
            'prompt'     => 'required|string',
        ]);

        // Save original room image
        $originalPath = $request->file('room_image')->store('ai_inputs', 'public');
        $absolutePath = storage_path("app/public/" . $originalPath);

        /**
         * ------------------------------------------------
         *  FREE AI ROOM REDESIGN (HuggingFace - Pix2Pix)
         * ------------------------------------------------
         * NO API KEY REQUIRED
         * 100% Free
         */
        $client = new Client(['verify' => false]);

        $imageBytes = file_get_contents($absolutePath);

        $response = $client->post(
            "https://api-inference.huggingface.co/models/timbrooks/instruct-pix2pix",
            [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    "inputs" => $request->prompt,
                    "image"  => base64_encode($imageBytes)
                ]
            ]
        );

        $result = json_decode($response->getBody(), true);

        // HuggingFace returns bytes in base64 format
        $outputBase64 = $result['data'][0]['image_base64'] ?? null;

        if (!$outputBase64) {
            return back()->with('error', 'AI could not generate image. Try another prompt.');
        }

        $aiBytes = base64_decode($outputBase64);

        // Save AI image
        $generatedPath = 'ai_outputs/' . time() . '_ai.png';
        Storage::disk('public')->put($generatedPath, $aiBytes);

        /**
         * --------------------------------------------
         * AI WORKER SUGGESTION (OpenAI - Text only)
         * --------------------------------------------
         */
        $analysis = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'Extract interior design style keywords from user prompt.'],
                ['role' => 'user', 'content' => $request->prompt]
            ]
        ]);

        $keywords = explode(',', strtolower($analysis->choices[0]->message->content));

        $workers = WorkerPortfolio::where(function ($q) use ($keywords) {
            foreach ($keywords as $word) {
                $q->orWhere('type', 'LIKE', "%$word%")
                  ->orWhere('tags', 'LIKE', "%$word%");
            }
        })->with('user')->get();


        return view('ai.result', [
            'originalImage'  => asset("storage/" . $originalPath),
            'generatedImage' => asset("storage/" . $generatedPath),
            'prompt'         => $request->prompt,
            'workers'        => $workers,
        ]);
    }
}
