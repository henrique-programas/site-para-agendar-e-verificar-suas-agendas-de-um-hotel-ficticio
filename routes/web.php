<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ─── Pública ────────────────────────────────────────────────────────────────

Route::get('/', fn() => view('pages.home'))->name('home');

// ─── Tudo abaixo exige login (cliente ou admin) ─────────────────────────────

Route::middleware(['auth'])->group(function () {
    // Páginas do site (protegidas)
    Route::get('/quartos', fn() => view('pages.rooms'))->name('rooms');
    Route::get('/sobre', fn() => view('pages.about'))->name('about');
    Route::get('/contato', fn() => view('pages.contact'))->name('contact');
    Route::get('/quartos/{id}', fn($id) => view('pages.room-detail', ['id' => $id]))->name('room.detail');

    // Área do Cliente
    Route::get('/dashboard', fn() => view('client.dashboard'))->name('dashboard');
    Route::get('/minhasReservas', fn() => view('client.reservas'))->name('reservation.index');
});

// ─── Área do Admin ───────────────────────────────────────────────────────────

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
    Route::get('/quartos', fn() => view('admin.quartos.index'))->name('quartos.index');
    Route::get('/reservas', fn() => view('admin.reservas.index'))->name('reservas.index');
    Route::get('/usuarios', fn() => view('admin.usuarios.index'))->name('usuarios.index');
});

// ─── Perfil ──────────────────────────────────────────────────────────────────

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
