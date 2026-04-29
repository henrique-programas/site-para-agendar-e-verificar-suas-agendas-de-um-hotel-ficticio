<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->paginate(12);
        return view('admin.quartos.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.quartos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number'          => 'required|string|max:10|unique:rooms,number',
            'name'            => 'required|string|max:120',
            'type'            => 'required|in:deluxe,premium,presidencial',
            'price_per_night' => 'required|numeric|min:1',
            'capacity'        => 'required|integer|min:1|max:20',
            'status'          => 'required|in:disponivel,ocupado,manutencao',
            'description'     => 'nullable|string',
            'image_url'       => 'nullable|url',
            'amenities'       => 'nullable|array',
            'amenities.*'     => 'string|max:50',
        ]);

        Room::create($data);

        return redirect()->route('admin.quartos.index')
            ->with('success', 'Quarto criado com sucesso.');
    }

    public function edit(Room $quarto)
    {
        return view('admin.quartos.edit', ['room' => $quarto]);
    }

    public function update(Request $request, Room $quarto)
    {
        $data = $request->validate([
            'number'          => ['required','string','max:10', Rule::unique('rooms','number')->ignore($quarto->id)],
            'name'            => 'required|string|max:120',
            'type'            => 'required|in:deluxe,premium,presidencial',
            'price_per_night' => 'required|numeric|min:1',
            'capacity'        => 'required|integer|min:1|max:20',
            'status'          => 'required|in:disponivel,ocupado,manutencao',
            'description'     => 'nullable|string',
            'image_url'       => 'nullable|url',
            'amenities'       => 'nullable|array',
            'amenities.*'     => 'string|max:50',
        ]);

        $quarto->update($data);

        return redirect()->route('admin.quartos.index')
            ->with('success', 'Quarto atualizado com sucesso.');
    }

    public function destroy(Room $quarto)
    {
        $quarto->delete();

        return redirect()->route('admin.quartos.index')
            ->with('success', 'Quarto removido com sucesso.');
    }
}
