<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class showMahasiswaHeader extends Controller
{
    public function showMahasiswaDashboard()
    {
        // Ambil data mahasiswa berdasarkan user yang sedang login
        $mahasiswa = Auth::user()->mahasiswa; // Misalnya menggunakan relasi mahasiswa yang sudah didefinisikan di model User

        // Kirim data ke view
        return view('admin.layouts.header', compact('mahasiswa'));
    }
}
