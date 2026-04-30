<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Client;
use Illuminate\Support\Facades\Route;

// ─── Pública ────────────────────────────────────────────────────────────────

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::post('/buscar-disponibilidade', [PagesController::class, 'homeCheckinSearch'])->name('home.checkin.search');

// ─── Tudo abaixo exige login (cliente ou admin) ─────────────────────────────

Route::middleware(['auth'])->group(function () {
    // Páginas do site (protegidas)
    Route::get('/quartos', [PagesController::class, 'rooms'])->name('rooms');
    Route::get('/quartos/{room}', [PagesController::class, 'roomDetail'])->name('room.detail');
    Route::get('/sobre', fn() => view('pages.about'))->name('about');
    Route::get('/contato', fn() => view('pages.contact'))->name('contact');
    Route::post('/contato/enviar', [PagesController::class, 'sendContact'])->name('contact.send');

    // Área do Cliente
    Route::get('/dashboard', [Client\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/minhasReservas', [Client\ReservationController::class, 'index'])->name('reservation.index');
    Route::get('/checkin', [Client\ReservationController::class, 'checkin'])->name('checkin');
    Route::post('/reservar/{room}', [Client\ReservationController::class, 'store'])->name('reservation.store');
    Route::patch('/minhasReservas/{reservation}/pagar-teste', [Client\ReservationController::class, 'fakePay'])->name('reservation.fakePay');
    Route::patch('/minhasReservas/{reservation}/cancelar', [Client\ReservationController::class, 'cancel'])->name('reservation.cancel');

    // Atendimento (evita /chat: algumas hospedagens bloqueiam essa URL em POST)
    Route::get('/atendimento', [Client\ChatController::class, 'index'])->name('chat');
    Route::post('/atendimento/enviar', [Client\ChatController::class, 'store'])->name('chat.store');
    Route::get('/atendimento/poll', [Client\ChatController::class, 'poll'])->name('chat.poll');
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

    // Atendimento ao cliente (URLs sem "chat")
    Route::get('/mensagens', [Admin\ChatController::class, 'index'])->name('chat.index');
    Route::get('/mensagens/{user}', [Admin\ChatController::class, 'show'])->name('chat.show');
    Route::post('/mensagens/{user}/enviar', [Admin\ChatController::class, 'store'])->name('chat.store');
    Route::get('/mensagens/{user}/poll', [Admin\ChatController::class, 'poll'])->name('chat.poll');
});

// ─── Perfil ──────────────────────────────────────────────────────────────────

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
