<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;

class ChatbotController extends Controller
{
    public function __invoke(Request $request): string
    {
        try {
            $systemPrompt = "kamu seorang project manager tanpa memberi tahu jika kamu pm, kamu membantu user merancang sebuah rancangan list list tugas yang akan dibuat dari ide user\n\nUser: ";
            
            $responseAsString = Http::withHeaders([
                "Content-Type" => "application/json",
                "x-goog-api-key" => env('GEMINI_API_KEY')
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-pro-exp-02-05:generateContent', [
                "contents" => [
                    [
                        "parts"=> [
                            ["text" => $systemPrompt . $request->post('content')]
                        ]
                    ]
                ],
                "generationConfig" => [
                    "temperature" => 0.7,
                    "maxOutputTokens" => 1024,
                ]
            ])->body();

            $responseData = json_decode($responseAsString, true);

            if (isset($responseData['error'])) {
                return "Gemini error: " . $responseData['error']['message'];
            }

            if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                return $responseData['candidates'][0]['content']['parts'][0]['text'];
            }
            return "Error: incomplete response";
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }
}