<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    public static function analyzePrompt(string $prompt): array
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . env('GEMINI_API_KEY'),
            [
                "contents" => [
                    [
                        "parts" => [
                            [
                                "text" => "
Analyze this interior design request and return JSON only.

Prompt: {$prompt}

Return JSON like:
{
  \"style\": \"modern / minimalist / luxury / classic\",
  \"colors\": [\"white\", \"warm light\"],
  \"furniture_add\": [],
  \"furniture_remove\": [],
  \"room_type\": \"bedroom / living room\"
}
"
                            ]
                        ]
                    ]
                ]
            ]
        );

        return $response->json();
    }
}
