<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// ─── Pública ────────────────────────────────────────────────────────────────

Route::get('/', [PagesController::class, 'home'])->name('home');

// ─── Tudo abaixo exige login (cliente ou admin) ─────────────────────────────

Route::middleware(['auth'])->group(function () {
    // Páginas do site (protegidas)
    Route::get('/quartos', [PagesController::class, 'rooms'])->name('rooms');
    Route::get('/quartos/{room}', [PagesController::class, 'roomDetail'])->name('room.detail');
    Route::get('/sobre', fn() => view('pages.about'))->name('about');
    Route::get('/contato', fn() => view('pages.contact'))->name('contact');

    // Área do Cliente
    Route::get('/dashboard', fn() => view('client.dashboard'))->name('dashboard');
    Route::get('/minhasReservas', fn() => view('client.reservas'))->name('reservation.index');
});

// ─── Área do Admin ───────────────────────────────────────────────────────────

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Quartos — CRUD completo via resource
    Route::resource('quartos', Admin\RoomController::class)->names([
        'index'   => 'quartos.index',
        'create'  => 'quartos.create',
        'store'   => 'quartos.store',
        'edit'    => 'quartos.edit',
        'update'  => 'quartos.update',
        'destroy' => 'quartos.destroy',
    ])->parameters(['quartos' => 'quarto']);

    // Reservas
    Route::get('/reservas', [Admin\ReservationController::class, 'index'])->name('reservas.index');
    Route::patch('/reservas/{reserva}/status', [Admin\ReservationController::class, 'updateStatus'])->name('reservas.status');
    Route::delete('/reservas/{reserva}', [Admin\ReservationController::class, 'destroy'])->name('reservas.destroy');

    // Usuários
    Route::get('/usuarios', [Admin\UserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [Admin\UserController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [Admin\UserController::class, 'store'])->name('usuarios.store');
    Route::patch('/usuarios/{usuario}/role', [Admin\UserController::class, 'updateRole'])->name('usuarios.role');
    Route::delete('/usuarios/{usuario}', [Admin\UserController::class, 'destroy'])->name('usuarios.destroy');
});

// ─── Perfil ──────────────────────────────────────────────────────────────────

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
