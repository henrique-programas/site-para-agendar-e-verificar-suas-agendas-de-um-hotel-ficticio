<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('f', 'todas'); // todas|pendentes|pagas|finalizadas|canceladas

        $baseQuery = Reservation::query()->where('user_id', auth()->id());

        $counts = [
            'todas'      => (clone $baseQuery)->count(),
            'pendentes'  => (clone $baseQuery)->where('status', 'pendente')->count(),
            'pagas'      => (clone $baseQuery)->whereIn('status', ['confirmado', 'andamento'])->count(),
            'finalizadas'=> (clone $baseQuery)->where('status', 'concluido')->count(),
            'canceladas' => (clone $baseQuery)->where('status', 'cancelado')->count(),
        ];

        $query = Reservation::with('room')->where('user_id', auth()->id());

        $query = match ($filter) {
            'pendentes'   => $query->where('status', 'pendente'),
            'pagas'       => $query->whereIn('status', ['confirmado', 'andamento']),
            'finalizadas' => $query->where('status', 'concluido'),
            'canceladas'  => $query->where('status', 'cancelado'),
            default       => $query,
        };

        $reservations = $query->latest()->paginate(10)->withQueryString();

        return view('client.reservas', compact('reservations', 'counts', 'filter'));
    }

    public function checkin(Request $request)
    {
        $filters = $request->validate([
            'check_in'  => 'nullable|date',
            'check_out' => 'nullable|date|after:check_in',
            'guests'    => 'nullable|integer|min:1|max:10',
            'type'      => 'nullable|string',
        ]);

        $rooms = collect();

        if (!empty($filters['check_in']) && !empty($filters['check_out'])) {
            $query = Room::query()->availableBetween($filters['check_in'], $filters['check_out']);

            if (!empty($filters['guests'])) {
                $query->where('capacity', '>=', (int) $filters['guests']);
            }

            if (!empty($filters['type']) && $filters['type'] !== 'todos') {
                $query->where('type', $filters['type']);
            }

            $rooms = $query->orderBy('price_per_night')->get();
        }

        return view('client.checkin', compact('rooms'));
    }

    public function store(Request $request, Room $room)
    {
        $data = $request->validate([
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests'    => 'required|integer|min:1',
            'notes'     => 'nullable|string|max:2000',
        ]);

        if ((int) $data['guests'] > (int) $room->capacity) {
            return back()->with('error', 'Número de hóspedes excede a capacidade do quarto.')->withInput();
        }

        $isAvailable = Room::query()
            ->whereKey($room->id)
            ->availableBetween($data['check_in'], $data['check_out'])
            ->exists();

        if (!$isAvailable) {
            return back()->with('error', 'Este quarto não está disponível para o período selecionado.')->withInput();
        }

        $checkIn = Carbon::parse($data['check_in'])->startOfDay();
        $checkOut = Carbon::parse($data['check_out'])->startOfDay();
        $nights = max(1, $checkIn->diffInDays($checkOut));

        Reservation::create([
            'user_id'         => auth()->id(),
            'room_id'         => $room->id,
            'check_in'        => $checkIn->toDateString(),
            'check_out'       => $checkOut->toDateString(),
            'guests'          => (int) $data['guests'],
            'price_per_night' => $room->price_per_night,
            'total_price'     => $room->price_per_night * $nights,
            'status'          => 'pendente',
            'notes'           => $data['notes'] ?? null,
        ]);

        return redirect()->route('reservation.index')->with('success', 'Reserva criada com sucesso! Aguarde a confirmação.');
    }

    public function fakePay(Reservation $reservation)
    {
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        if ($reservation->status !== 'pendente') {
            return back()->with('error', 'Apenas reservas pendentes podem ser pagas (teste).');
        }

        $reservation->update([
            'status'       => 'confirmado',
            'confirmed_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Pagamento fictício realizado! Reserva confirmada.');
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->loadMissing('room');

        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        if (!in_array($reservation->status, ['pendente', 'confirmado'], true)) {
            return back()->with('error', 'Esta reserva não pode mais ser cancelada.');
        }

        if ($reservation->checked_in_at) {
            return back()->with('error', 'Não é possível cancelar após o check-in.');
        }

        $reservation->update([
            'status'       => 'cancelado',
            'cancelled_at' => Carbon::now(),
        ]);

        if ($reservation->room && $reservation->room->status !== 'manutencao') {
            $reservation->room->update(['status' => 'disponivel']);
        }

        return back()->with('success', 'Reserva cancelada com sucesso.');
    }
}

