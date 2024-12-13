<?php

use App\Http\Controllers\DosenController;
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


Route::middleware(['auth', 'role:admin'])->group(function () {
    // prodi
    Route::get('/prodi', [ProdiController::class, "index"])->name('prodi');
    Route::post('/prodi', [ProdiController::class, "store"])->name('add-prodi');
    Route::put('/prodi/{prodi}', [ProdiController::class, "update"])->name('edit-prodi');
    Route::delete('/prodi/{prodi}', [ProdiController::class, "destroy"])->name('delete-prodi');
    
    // mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, "index"])->name('mahasiswa');
    Route::post('/mahasiswa', [MahasiswaController::class, "store"])->name('add-mahasiswa');
    Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, "update"])->name('edit-mahasiswa');
    Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, "destroy"])->name('delete-mahasiswa');

    // dosen
    Route::get('/dosen', [DosenController::class, "index"])->name('dosen');
    Route::post('/dosen', [DosenController::class, "store"])->name('add-dosen');
});






require __DIR__.'/auth.php';
