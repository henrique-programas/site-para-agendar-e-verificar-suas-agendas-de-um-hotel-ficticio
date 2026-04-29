<?php

namespace App\Http\Controllers;

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

        $rooms = $query->orderBy('price_per_night')->paginate(9)->withQueryString();

        if ($request->ajax()) {
            return view('pages.partials.rooms-grid', compact('rooms'));
        }

        return view('pages.rooms', compact('rooms'));
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
