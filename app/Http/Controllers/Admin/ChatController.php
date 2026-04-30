<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $conversations = User::query()
            ->whereHas('chatMessages')
            ->withMax('chatMessages', 'created_at')
            ->orderByDesc('chat_messages_max_created_at')
            ->get();

        return view('admin.chat.index', compact('conversations'));
    }

    public function show(User $user)
    {
        $messages = ChatMessage::query()
            ->where('user_id', $user->id)
            ->orderBy('id')
            ->get();

        return view('admin.chat.show', compact('user', 'messages'));
    }

    public function store(Request $request, User $user)
    {
        $data = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        ChatMessage::create([
            'user_id' => $user->id,
            'sender'  => 'admin',
            'message' => trim($data['message']),
        ]);

        return back()->with('success', 'Resposta enviada.');
    }

    public function poll(Request $request, User $user)
    {
        $afterId = (int) $request->query('after_id', 0);

        $messages = ChatMessage::query()
            ->where('user_id', $user->id)
            ->where('id', '>', $afterId)
            ->orderBy('id')
            ->get(['id', 'sender', 'message', 'created_at']);

        return response()->json([
            'messages' => $messages,
        ]);
    }
}

