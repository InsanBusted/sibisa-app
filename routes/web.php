<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumDiskusiController;
use App\Http\Controllers\JadwalBimbinganController;
use App\Http\Controllers\jadwalMailController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\RiwayatBimbinganController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (Auth::check()) {
        if (Auth::user()->hasRole('dosen')) {
            return redirect()->route('index-dosen'); 
        } elseif (Auth::user()->hasRole('mahasiswa')) {
            return redirect()->route('index-mahasiswa'); 
        } elseif (Auth::user()->hasRole('admin')) {
            return redirect()->route('dashboard'); 
        }
    }
    return view('welcome');
})->name('beranda');



Route::get('/send-mail', [jadwalMailController::class, 'index']);

Route::middleware(['auth', 'role:admin|mahasiswa'])->group(function () {
    Route::get('/mhs', [MahasiswaController::class, 'index2'])->name('index-mahasiswa');

    // jadwall bimbingan
    Route::get('/mhs/jadwal', [JadwalBimbinganController::class, 'index'])->name('dashboard-mahasiswa');
    Route::post('/mhs/jadwal', [JadwalBimbinganController::class, "store2"])->name('add-jadwal-mahasiswa');
    Route::put('/mhs/jadwal/{jadwalbimbingan}', [JadwalBimbinganController::class, "update2"])->name('edit-jadwal-mahasiswa');
    Route::delete('/mhs/jadwal/{jadwalbimbingan}', [JadwalBimbinganController::class, "destroy2"])->name('delete-jadwal-mahasiswa');

    // riwayat bimbingan
    Route::post('/mhs/riwayat', [RiwayatBimbinganController::class, "store2"])->name('add-riwayat-mahasiswa');
    Route::put('/mhs/riwayat/{riwayatBimbingan}', [RiwayatBimbinganController::class, "update2"])->name('edit-riwayat-mahasiswa');
    // Route::put('/mhs/riwayat/{riwayatBimbingan}/edited', [RiwayatBimbinganController::class, "update2"])->name('update-riwayat-mahasiswa');
    Route::get('/mhs/riwayat', [RiwayatBimbinganController::class, "show2"])->name('riwayat-mahasiswa');

    // Forum Diskusi
    Route::get('/mhs/forums', [ForumController::class, "index2"])->name('forum-mahasiswa');
    Route::post('/mhs/forums', [ForumController::class, "store2"])->name('add-forum-mahasiswa');
    Route::put('/mhs/forums/{forum}', [ForumController::class, "update2"])->name('edit-forum-mahasiswa');
    Route::get('/mhs/forum/{id}', [ForumController::class, 'show2'])->name('detail-forum-mahasiswa');
    Route::delete('/mhs/forum/{forum}', [ForumController::class, "destroy2"])->name('delete-forum-mahasiswa');
    Route::get('/mhs/forums/search', [ForumController::class, 'search2'])->name('search-forum-mahasiswa');
    Route::post('/mhs/forums/{forumId}/replies', [ReplyController::class, 'store2'])->name('add-reply-mahasiswa');
});

Route::middleware(['auth', 'role:admin|dosen'])->group(function () {
    Route::get('/dsn', [DosenController::class, 'index2'])->name('index-dosen');

    // jadwall bimbingan 
    Route::get('/dsn/jadwal', [JadwalBimbinganController::class, 'index2'])->name('dashboard-dosen');
    Route::post('/dsn/jadwal', [JadwalBimbinganController::class, "store3"])->name('add-jadwal-dosen');
    Route::put('/dsn/jadwal/{jadwalbimbingan}', [JadwalBimbinganController::class, "update3"])->name('edit-jadwal-dosen');
    Route::delete('/dsn/jadwal/{jadwalbimbingan}', [JadwalBimbinganController::class, "destroy3"])->name('delete-jadwal-dosen');

    // riwayat bimbingan
    Route::post('/dsn/riwayat', [RiwayatBimbinganController::class, "store3"])->name('add-riwayat-dosen');
    Route::put('/dsn/riwayat/{riwayatBimbingan}', [RiwayatBimbinganController::class, "update3"])->name('edit-riwayat-dosen');
    // Route::put('/dsn/riwayat/{riwayatBimbingan}/edited', [RiwayatBimbinganController::class, "update2"])->name('update-riwayat-dosen');
    Route::get('/dsn/riwayat', [RiwayatBimbinganController::class, "show3"])->name('riwayat-dosen');

    // Forum Diskusi
    Route::get('/dsn/forums', [ForumController::class, "index3"])->name('forum-dosen');
    Route::post('/dsn/forums', [ForumController::class, "store3"])->name('add-forum-dosen');
    Route::put('/dsn/forums/{forum}', [ForumController::class, "update3"])->name('edit-forum-dosen');
    Route::get('/dsn/forum/{id}', [ForumController::class, 'show3'])->name('detail-forum-dosen');
    Route::delete('/dsn/forum/{forum}', [ForumController::class, "destroy3"])->name('delete-forum-dosen');
    Route::get('/dsn/forums/search', [ForumController::class, 'search3'])->name('search-forum-dosen');
    Route::post('/dsn/forums/{forumId}/replies', [ReplyController::class, 'store3'])->name('add-reply-dosen');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [JadwalBimbinganController::class, "index"])->name('dashboard');
    Route::put('/dashboard/{jadwalbimbingan}', [JadwalBimbinganController::class, "update"])->name('edit-jadwal');
    Route::get('/jadwal-bimbingan/search', [JadwalBimbinganController::class, 'search'])->name('search-jadwal');
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
