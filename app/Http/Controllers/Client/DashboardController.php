<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $latestReservations = Reservation::with('room')
            ->where('user_id', auth()->id())
            ->latest()
            ->limit(3)
            ->get();

        $latestMessages = ChatMessage::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->limit(3)
            ->get()
            ->reverse()
            ->values();

        $unreadFromAdmin = ChatMessage::query()
            ->where('user_id', auth()->id())
            ->where('sender', 'admin')
            ->whereNull('read_at')
            ->count();

        return view('client.dashboard', compact('latestReservations', 'latestMessages', 'unreadFromAdmin'));
    }
}

