<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index()
    {
        return view('pages.chatbot');
    }

    public function send(Request $request)
    {
        try {
            $userMessage = $request->input('message');
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
                'HTTP-Referer' => 'http://127.0.0.1:8000',
                'X-Title' => 'Laravel Free Chatbot',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'mistralai/mistral-7b-instruct',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are MedBot, an AI medical assistant trained to help users with medical questions. Only answer questions related to health, symptoms, medicine, or treatment. Do not answer general or personal questions.'],
                    ['role' => 'user', 'content' => $userMessage],
                ]
            ]);


            if ($response->failed()) {
                return response()->json(['error' => $response->body()]);
            }

            $botReply = $response['choices'][0]['message']['content'] ?? 'No reply.';
            return response()->json(['reply' => $botReply]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
