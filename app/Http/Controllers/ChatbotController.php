<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function handleChat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = $request->input('message');
        $apiKey = config('services.groq.key');

        if (!$apiKey) {
            return response()->json([
                'reply' => "Sistem AI Neura sedang dalam mode pemeliharaan (API Key belum dikonfigurasi). Silakan hubungi Sales RM Anda secara langsung."
            ]);
        }

        try {
            $response = Http::withToken($apiKey)
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'openai/gpt-oss-120b',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => "Kamu adalah Neura model 2b7t, asisten AI premium dan eksklusif untuk Apex Automotive. Bicaralah dengan nada elegan, mewah, dan profesional. 
KAMU WAJIB MEMBALAS HANYA DENGAN FORMAT JSON VALID tanpa tambahan apapun, dengan struktur:
{
  \"reply\": \"Teks balasan kamu di sini\",
  \"action\": \"kode_aksi_di_bawah_jika_relevan\"
}
KODE AKSI YANG TERSEDIA (gunakan salah satu yang paling relevan dengan konteks user, atau null jika tidak ada):
- focus_login : jika user bertanya cara login, mendaftar, atau masuk ke akun.
- focus_service : jika user bertanya tentang servis, perawatan, booking maintenance.
- open_account : jika user bertanya profil, data diri, atau pengaturan akun.
- focus_search : jika user bertanya cara mencari mobil, filter mobil, atau mencari model tertentu.
- focus_dealer : jika user bertanya lokasi dealer, alamat showroom, atau tempat Apex Automotive berada.
"
                        ],
                        [
                            'role' => 'user',
                            'content' => $message
                        ]
                    ],
                    'response_format' => ['type' => 'json_object'],
                    'max_tokens' => 1500,
                    'temperature' => 0.4,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $content = $data['choices'][0]['message']['content'] ?? '{}';
                
                // Attempt to decode the LLM's JSON response
                $parsed = json_decode($content, true);
                
                if (json_last_error() === JSON_ERROR_NONE && isset($parsed['reply'])) {
                    return response()->json([
                        'reply' => $parsed['reply'],
                        'action' => $parsed['action'] ?? null
                    ]);
                }

                // Fallback if not valid JSON
                return response()->json(['reply' => $content, 'action' => null]);
            }

            Log::error('Groq API Error: ' . $response->body());
            return response()->json([
                'reply' => "Mohon maaf, Neura sedang mengalami gangguan koneksi. Silakan coba beberapa saat lagi."
            ], 500);

        } catch (\Exception $e) {
            Log::error('Chatbot Controller Exception: ' . $e->getMessage());
            return response()->json([
                'reply' => "Terjadi kesalahan internal. Tim teknisi kami sedang menanganinya."
            ], 500);
        }
    }
}
