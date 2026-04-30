<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Room;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $rooms = Room::where('status', 'disponivel')
            ->orderBy('price_per_night')
            ->limit(3)
            ->get();

        return view('pages.home', compact('rooms'));
    }

    public function rooms(Request $request)
    {
        $query = Room::query();

        if ($request->filled('check_in') && $request->filled('check_out')) {
            $query->availableBetween($request->check_in, $request->check_out);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type') && $request->type !== 'todos') {
            $query->where('type', $request->type);
        }

        if ($request->filled('price')) {
            match ($request->price) {
                'ate500'   => $query->where('price_per_night', '<=', 500),
                '500a1000' => $query->whereBetween('price_per_night', [500, 1000]),
                'acima1000'=> $query->where('price_per_night', '>', 1000),
                default    => null,
            };
        }

        if ($request->filled('capacity')) {
            $cap = (int) $request->capacity;
            if ($cap >= 4) {
                $query->where('capacity', '>=', 4);
            } else {
                $query->where('capacity', $cap);
            }
        }

        if ($request->filled('guests')) {
            $query->where('capacity', '>=', (int) $request->guests);
        }

        $rooms = $query->orderBy('price_per_night')->paginate(9)->withQueryString();

        if ($request->ajax()) {
            return view('pages.partials.rooms-grid', compact('rooms'));
        }

        return view('pages.rooms', compact('rooms'));
    }

    public function homeCheckinSearch(Request $request)
    {
        $data = $request->validate([
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests'    => 'nullable|integer|min:1|max:10',
        ]);

        $params = [
            'check_in'  => $data['check_in'],
            'check_out' => $data['check_out'],
        ];

        if (!empty($data['guests'])) {
            $params['guests'] = (int) $data['guests'];
        }

        if (auth()->check()) {
            return redirect()->route('rooms', $params);
        }

        $request->session()->put('home_checkin_search', $params);
        $request->session()->put('url.intended', route('rooms', $params));

        return redirect()->route('login')
            ->with('error', 'Faça login para concluir sua busca de disponibilidade.');
    }

    public function sendContact(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'nullable|string|max:50',
            'subject'   => 'required|string|max:50',
            'checkin'   => 'nullable|date',
            'checkout'  => 'nullable|date|after:checkin',
            'room_type' => 'nullable|string|max:255',
            'message'   => 'required|string|max:2000',
        ]);

        $subjectLabels = [
            'reserva' => 'Reserva',
            'preco'   => 'Preços e Tarifas',
            'evento'  => 'Eventos & Corporativo',
            'outro'   => 'Outro',
        ];

        $lines = [];
        $lines[] = 'Contato pelo site';
        $lines[] = 'Assunto: ' . ($subjectLabels[$data['subject']] ?? $data['subject']);
        $lines[] = 'Nome: ' . $data['name'];
        $lines[] = 'Email: ' . $data['email'];
        if (!empty($data['phone'])) $lines[] = 'Telefone: ' . $data['phone'];
        if (!empty($data['checkin'])) $lines[] = 'Check-in: ' . $data['checkin'];
        if (!empty($data['checkout'])) $lines[] = 'Check-out: ' . $data['checkout'];
        if (!empty($data['room_type'])) $lines[] = 'Acomodação: ' . $data['room_type'];
        $lines[] = 'Mensagem:';
        $lines[] = trim($data['message']);

        ChatMessage::create([
            'user_id' => auth()->id(),
            'sender'  => 'user',
            'message' => implode("\n", $lines),
        ]);

        return redirect()->route('chat')->with('success', 'Mensagem enviada! Nossa equipe responderá pelo chat.');
    }

    public function roomDetail(Room $room)
    {
        $relacionados = Room::where('id', '!=', $room->id)
            ->where('type', $room->type)
            ->limit(3)
            ->get();

        if ($relacionados->count() < 3) {
            $relacionados = Room::where('id', '!=', $room->id)
                ->limit(3)
                ->get();
        }

        return view('pages.room-detail', compact('room', 'relacionados'));
    }
}
