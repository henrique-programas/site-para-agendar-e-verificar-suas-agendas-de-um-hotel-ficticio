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

    public function checkIn(Reservation $reserva)
    {
        if (in_array($reserva->status, ['cancelado', 'concluido'], true)) {
            return back()->with('error', 'Não é possível fazer check-in em uma reserva cancelada/concluída.');
        }

        if ($reserva->checked_in_at) {
            return back()->with('error', 'Esta reserva já teve check-in.');
        }

        if ($reserva->status !== 'confirmado') {
            return back()->with('error', 'Para fazer check-in, a reserva precisa estar confirmada.');
        }

        $reserva->update([
            'checked_in_at' => Carbon::now(),
            'status'        => 'andamento',
        ]);

        return back()->with('success', 'Check-in realizado com sucesso.');
    }

    public function checkOut(Reservation $reserva)
    {
        if (in_array($reserva->status, ['cancelado', 'concluido'], true)) {
            return back()->with('error', 'Não é possível fazer check-out em uma reserva cancelada/concluída.');
        }

        if (!$reserva->checked_in_at) {
            return back()->with('error', 'Faça o check-in antes de realizar o check-out.');
        }

        if ($reserva->checked_out_at) {
            return back()->with('error', 'Esta reserva já teve check-out.');
        }

        if ($reserva->status !== 'andamento') {
            return back()->with('error', 'A reserva precisa estar em andamento para fazer check-out.');
        }

        $reserva->update([
            'checked_out_at' => Carbon::now(),
            'status'         => 'concluido',
        ]);

        return back()->with('success', 'Check-out realizado com sucesso.');
    }

    public function destroy(Reservation $reserva)
    {
        $reserva->delete();

        return redirect()->route('admin.reservas.index')
            ->with('success', 'Reserva removida.');
    }
}
