<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumDiskusiController;
use App\Http\Controllers\JadwalBimbinganController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\RiwayatBimbinganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin|mahasiswa'])->group(function () {
    Route::get('/mhs', [MahasiswaController::class, 'index2'])->name('index-mahasiswa');
    Route::get('/mhs/dashboard', [JadwalBimbinganController::class, 'index'])->name('dashboard-mahasiswa');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [JadwalBimbinganController::class, "index"])->name('dashboard');
    Route::put('/dashboard/{jadwalbimbingan}', [JadwalBimbinganController::class, "update"])->name('edit-jadwal');
    Route::get('/search', [JadwalBimbinganController::class, 'search'])->name('search-jadwal');
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
    Route::get('/mahasiswa/{id}/detail', [MahasiswaController::class, 'show'])->name('detail-mahasiswa');
    
    
    
    // dosen
    Route::get('/dosen', [DosenController::class, "index"])->name('dosen');
    Route::post('/dosen', [DosenController::class, "store"])->name('add-dosen');
    Route::put('/dosen/{dosen}', [DosenController::class, "update"])->name('edit-dosen');
    Route::delete('/dosen/{dosen}', [DosenController::class, "destroy"])->name('delete-dosen');
    Route::get('/dosen/search', [DosenController::class, 'search'])->name('search-dosen');
    Route::get('/dosen/{id}/detail', [DosenController::class, 'show'])->name('detail-dosen');
    Route::put('/dosen/jadwal/{jadwaldetail}/update', [DosenController::class, 'updateDetail'])->name('edit-detail');
    
    // Forum Diskusi
    Route::get('/forums', [ForumController::class, "index"])->name('forum');
    Route::post('/forums', [ForumController::class, "store"])->name('add-forum');
    Route::put('/forums/{forum}', [ForumController::class, "update"])->name('edit-forum');
    Route::get('/forum/{id}', [ForumController::class, 'show'])->name('detail-forum');
    Route::delete('/forum/{forum}', [ForumController::class, "destroy"])->name('delete-forum');
    Route::get('/forums/search', [ForumController::class, 'search'])->name('search-forum');
    Route::post('/forums/{forumId}/replies', [ReplyController::class, 'store'])->name('add-reply');
    
    // Riwayat Bimbingan
    Route::get('/riwayat', [RiwayatBimbinganController::class, "index"])->name('riwayat');
    Route::post('/riwayat', [RiwayatBimbinganController::class, "store"])->name('add-riwayat');
    Route::get('/riwayat/{id}/edit', [RiwayatBimbinganController::class, "edit"])->name('edit-riwayat');
    Route::put('/riwayat/{riwayatBimbingan}/edited', [RiwayatBimbinganController::class, "update"])->name('update-riwayat');
    Route::get('/riwayat/{mahasiswaId}', [RiwayatBimbinganController::class, "show"])->name('detail-riwayat');
    
});






require __DIR__.'/auth.php';
