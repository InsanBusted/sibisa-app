<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(middleware: ['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin|mahasiswa'])->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, "index"])->name('mahasiswa');
    Route::post('/mahasiswa', [MahasiswaController::class, "store"])->name('add-mahasiswa');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/prodi', [ProdiController::class, "index"])->name('prodi');
});






require __DIR__.'/auth.php';
