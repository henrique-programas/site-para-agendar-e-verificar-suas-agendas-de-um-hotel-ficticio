<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::withCount('reservations');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(fn($q) => $q->where('name', 'like', "%$search%")
                                       ->orWhere('email', 'like', "%$search%"));
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        $counts = [
            'total'          => User::count(),
            'admins'         => User::where('role', 'admin')->count(),
            'clientes'       => User::where('role', 'client')->count(),
            'novos_semana'   => User::whereBetween('created_at', [now()->startOfWeek(), now()])->count(),
        ];

        return view('admin.usuarios.index', compact('users', 'counts'));
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role'     => 'required|in:client,admin',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuário criado com sucesso.');
    }

    public function updateRole(Request $request, User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'Você não pode alterar seu próprio perfil.');
        }

        $request->validate(['role' => 'required|in:client,admin']);

        $usuario->update(['role' => $request->role]);

        $label = $request->role === 'admin' ? 'Promovido a administrador' : 'Rebaixado a cliente';

        return back()->with('success', "$label com sucesso.");
    }

    public function destroy(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return back()->with('error', 'Você não pode remover sua própria conta.');
        }

        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuário removido com sucesso.');
    }
}
