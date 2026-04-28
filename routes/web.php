<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//////////////////////////////////////////////////

Route::get('/', function () {
    return view('pages.home');
})->name('home');

route::get('/quartos', function () {
    return view('pages.rooms');
})->name('rooms');

Route::get('/sobre', function () {
    return view('pages.about');
})->name('about');

Route::get('/contato', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/quartos/{id}', function ($id) {
    return view('pages.room-detail', ['id' => $id]);
})->name('room.detail');

//////////////////////////////////////////////////

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
