<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
   public function ask($question)
{
    $apiKey = config('services.gemini.api_key');

    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=".$apiKey;

    $response = Http::post($url, [
        "contents" => [
            [
                "parts" => [
                    [
                        "text" => $question
                    ]
                ]
            ]
        ]
    ]);

    if ($response->successful()) {

        return $response->json();

    }

    return null;
}
}