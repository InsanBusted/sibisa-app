<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalBimbinganController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use App\Models\JadwalBimbingan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [JadwalBimbinganController::class, "index"])->name('dashboard');
    Route::put('/dashboard/{jadwalbimbingan}', [JadwalBimbinganController::class, "update"])->name('edit-jadwal');
    Route::delete('/dashboard/{jadwalbimbingan}', [JadwalBimbinganController::class, "destroy"])->name('delete-jadwal');
    Route::post('/dashboard', [JadwalBimbinganController::class, "store"])->name('add-jadwal');
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
    Route::get('/mahasiswa/search', [MahasiswaController::class, 'search'])->name('search-mahasiswa');


    

    // dosen
    Route::get('/dosen', [DosenController::class, "index"])->name('dosen');
    Route::post('/dosen', [DosenController::class, "store"])->name('add-dosen');
    Route::put('/dosen/{dosen}', [DosenController::class, "update"])->name('edit-dosen');
    Route::delete('/dosen/{dosen}', [DosenController::class, "destroy"])->name('delete-dosen');
    Route::get('/search', [DosenController::class, 'search'])->name('search-dosen');
    Route::get('/dosen/{id}/detail', [DosenController::class, 'show'])->name('detail-dosen');

});






require __DIR__.'/auth.php';
