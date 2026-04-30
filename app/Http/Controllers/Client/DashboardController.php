<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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

        return view('client.dashboard', compact('latestReservations'));
    }
}

