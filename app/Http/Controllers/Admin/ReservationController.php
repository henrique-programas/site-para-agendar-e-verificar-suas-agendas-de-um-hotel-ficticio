<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['user', 'room']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', fn($q) => $q->where('name', 'like', "%$search%")
                                                   ->orWhere('email', 'like', "%$search%"));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tipo')) {
            $query->whereHas('room', fn($q) => $q->where('type', $request->tipo));
        }

        $reservations = $query->latest()->paginate(10)->withQueryString();

        $counts = [
            'total'      => Reservation::whereMonth('created_at', now()->month)->count(),
            'confirmado' => Reservation::where('status', 'confirmado')->count(),
            'pendente'   => Reservation::where('status', 'pendente')->count(),
            'cancelado'  => Reservation::where('status', 'cancelado')->count(),
            'andamento'  => Reservation::where('status', 'andamento')->count(),
        ];

        return view('admin.reservas.index', compact('reservations', 'counts'));
    }

    public function updateStatus(Request $request, Reservation $reserva)
    {
        $request->validate([
            'status' => 'required|in:pendente,confirmado,andamento,concluido,cancelado',
        ]);

        $data = ['status' => $request->status];

        if ($request->status === 'confirmado') {
            $data['confirmed_at'] = Carbon::now();
        }
        if ($request->status === 'cancelado') {
            $data['cancelled_at'] = Carbon::now();
        }

        $reserva->update($data);

        return back()->with('success', 'Status da reserva atualizado.');
    }

    public function destroy(Reservation $reserva)
    {
        $reserva->delete();

        return redirect()->route('admin.reservas.index')
            ->with('success', 'Reserva removida.');
    }
}
