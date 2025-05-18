<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use App\Models\ChatHistory;
use Carbon\Carbon;
use Throwable;

class ChatbotController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $user = Auth::user();
            
            // Cek limit chat user
            if ($user->tier !== 'PRO' && $user->ischatting <= 0) {
                return response()->json([
                    'error' => true,
                    'message' => 'chat_limit_reached'
                ], 403);
            }
            
            // Ambil riwayat chat (5 percakapan terakhir)
            $chatHistory = ChatHistory::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->take(2) // Kurangi dari 5 ke 2 pesan terakhir saja
                ->get()
                ->reverse()
                ->values();
            
            // GEMINI API
            $apiKey = env('GEMINI_API_KEY');
            if (empty($apiKey)) {
                return "Error: API key kosong di .env";
            }

            // Kurangi jumlah chat yang tersedia (kecuali user PRO)
            if ($user->tier !== 'PRO') {
                $user->ischatting -= 1;
                $user->save();
            }
            
            // Format riwayat chat untuk Gemini
            $formattedHistory = [];
            foreach ($chatHistory as $chat) {
                $formattedHistory[] = [
                    "role" => "user",
                    "parts" => [["text" => $chat->user_message]]
                ];
                $formattedHistory[] = [
                    "role" => "model",
                    "parts" => [["text" => $chat->bot_response]]
                ];
            }
            
            // Modifikasi system prompt untuk menghemat token
            $systemPrompt = "Kamu asisten Project Manager yang memberikan saran tugas. PENTING: Berikan jawaban SINGKAT dan PADAT (maks 300 kata). Gunakan poin-poin jika perlu dan tanyakan dulu kebutuhanya. Jangan basa-basi.";
            
            // Dengan format yang benar untuk model Gemini:
            $systemPrompt = "Kamu asisten Project Manager yang memberikan saran tugas. Berikan jawaban singkat dan padat. Gunakan poin-poin jika perlu dan tanyakan dulu kebutuhannya. Jangan basa-basi.";

            $payload = [
                "contents" => [],
            ];

            // Gunakan parameter generationConfig untuk mengontrol panjang output
            $payload["generationConfig"] = [
                "temperature" => 0.9,
                "maxOutputTokens" => 800,
                "topP" => 0.95,
            ];

            // Gunakan parameter khusus untuk system instruction
            $payload["safetySettings"] = [
                [
                    "category" => "HARM_CATEGORY_DANGEROUS_CONTENT",
                    "threshold" => "BLOCK_NONE"
                ]
            ];

            // Tambahkan system message HANYA sebagai pesan pertama
            if (count($formattedHistory) > 0) {
                // Jika ada riwayat, gunakan riwayat
                $payload["contents"] = $formattedHistory;
            } else {
                // Jika tidak ada riwayat, tambahkan pesan "model" sebagai respons awal
                $payload["contents"] = [
                    [
                        "role" => "model",
                        "parts" => [["text" => "Hai! Aku Roki, project manager yang bisa membantu kamu merancang tugas. Ada yang bisa kubantu?"]]
                    ]
                ];
            }
            
            // Instruksi untuk respons singkat di chat baru
            $userMessage = $request->post('content');
            
            // Simpan pesan asli user tanpa batasan
            $originalUserMessage = $request->post('content');

            // Buat salinan untuk API dengan batasan
            $apiUserMessage = $originalUserMessage . " (Tolong jawab singkat dan padat tidak lebih dari 300 kata, tanyakan kebutuhanya dulu jika perlu)";

            // Tambahkan pesan user terbaru
            $payload["contents"][] = [
                "role" => "user",
                "parts" => [["text" => $apiUserMessage]]
            ];
            
            // Tambahkan generationConfig
            $payload["generationConfig"] = [
                "temperature" => 0.9,
                "maxOutputTokens" => 800, // Batasi output token
                "topP" => 0.95,
            ];
            
            \Log::info('Gemini request with history', [
                'history_count' => count($formattedHistory),
                'latest_message' => $userMessage
            ]);
            
            $responseAsString = Http::withHeaders([
                "Content-Type" => "application/json",
                "x-goog-api-key" => $apiKey
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent', $payload)->body();

            $responseData = json_decode($responseAsString, true);

            if (isset($responseData['error'])) {
                return "Gemini error: " . $responseData['error']['message'];
            }

            $botResponse = "";
            if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                $botResponse = $responseData['candidates'][0]['content']['parts'][0]['text'];
                
                // Deteksi jika respons mungkin terpotong
                if (strlen($botResponse) >= 7800 || !preg_match('/[.!?]$/', trim($botResponse))) {
                    $botResponse .= "\n\n*(Respons dipotong karena terlalu panjang)*";
                }

                // Pastikan markdown code blocks selalu ditutup dengan benar
                if (substr_count($botResponse, "```") % 2 !== 0) {
                    $botResponse .= "\n```";
                }
                
                // Simpan percakapan ke database
                ChatHistory::create([
                    'user_id' => $user->id,
                    'user_message' => $originalUserMessage, // Pesan asli tanpa batasan
                    'bot_response' => $botResponse,
                ]);
                
                return $botResponse;
            }
            return "Error: incomplete response";
            
        } catch (Throwable $e) {
            return "Terjadi kesalahan: " . $e->getMessage();
        }
    }

    public function chatbot()
    {
        $user = Auth::user();
        // Hanya cek apakah memiliki kuota chat tetapi tetap tampilkan riwayat
        $hasChatQuota = ($user->tier === 'PRO' || $user->ischatting > 0);
        $packages = Package::all();
        $chatHistory = ChatHistory::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->reverse()
            ->values();
        
        return view('chatbot', compact('hasChatQuota', 'packages', 'chatHistory'));
    }
}