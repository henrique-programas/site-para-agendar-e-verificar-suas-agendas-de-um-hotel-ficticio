<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $stats = [
            'reservas_hoje'    => Reservation::whereDate('check_in', $today)->count(),
            'quartos_ocupados' => Room::where('status', 'ocupado')->count(),
            'quartos_total'    => Room::count(),
            'receita_mes'      => Reservation::whereMonth('created_at', $today->month)
                                    ->whereYear('created_at', $today->year)
                                    ->whereNotIn('status', ['cancelado'])
                                    ->sum('total_price'),
            'clientes_total'   => User::where('role', 'client')->count(),
            'novos_semana'     => User::where('role', 'client')
                                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])
                                    ->count(),
        ];

        $reservasRecentes = Reservation::with(['user', 'room'])
            ->latest()
            ->limit(5)
            ->get();

        $statusQuartos = Room::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'reservasRecentes', 'statusQuartos'));
    }
}
