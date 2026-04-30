<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    private function ensureStarted()
    {
        $hasUserMessage = ChatMessage::query()
            ->where('user_id', auth()->id())
            ->where('sender', 'user')
            ->exists();

        if (!$hasUserMessage) {
            return redirect()->route('contact')
                ->with('error', 'Para abrir o chat, envie primeiro uma mensagem pelo formulário de contato.');
        }

        return null;
    }

    public function index()
    {
        if ($resp = $this->ensureStarted()) {
            return $resp;
        }

        $messages = ChatMessage::query()
            ->where('user_id', auth()->id())
            ->orderBy('id')
            ->get();

        return view('client.chat', compact('messages'));
    }

    public function store(Request $request)
    {
        if ($resp = $this->ensureStarted()) {
            return $resp;
        }

        $data = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        ChatMessage::create([
            'user_id' => auth()->id(),
            'sender'  => 'user',
            'message' => trim($data['message']),
        ]);

        return back()->with('success', 'Mensagem enviada.');
    }

    public function poll(Request $request)
    {
        $hasUserMessage = ChatMessage::query()
            ->where('user_id', auth()->id())
            ->where('sender', 'user')
            ->exists();
        if (!$hasUserMessage) {
            abort(403);
        }

        $afterId = (int) $request->query('after_id', 0);

        $messages = ChatMessage::query()
            ->where('user_id', auth()->id())
            ->where('id', '>', $afterId)
            ->orderBy('id')
            ->get(['id', 'sender', 'message', 'created_at']);

        return response()->json([
            'messages' => $messages,
        ]);
    }
}

