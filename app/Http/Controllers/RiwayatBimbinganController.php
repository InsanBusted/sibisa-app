<?php

namespace App\Http\Controllers;

use App\Models\JadwalBimbingan;
use App\Models\Mahasiswa;
use App\Models\RiwayatBimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RiwayatBimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Ambil daftar mahasiswa yang terdaftar untuk bimbingan
         $mahasiswas = Mahasiswa::with('jadwalbimbingan.dosen')
         ->whereHas('jadwalbimbingan')
         ->paginate(10);

    return view('riwayat_bimbingan.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jadwal_bimbingan_id' => 'required|exists:jadwal_bimbingans,id',
            'catatan_dosen' => 'nullable|string',
            'catatan_mahasiswa' => 'nullable|string',
            'status' => 'required|in:Proses,Revisi,ACC',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:5048', // Validasi file (maksimal 5MB)
        ]);
    
        // Ambil jadwal bimbingan yang dipilih berdasarkan jadwal_bimbingan_id
        $jadwalBimbingan = JadwalBimbingan::findOrFail($request->jadwal_bimbingan_id);
    
        // Hapus riwayat bimbingan yang sudah ada untuk jadwal_bimbingan_id yang sama
        $jadwalBimbingan->riwayatBimbingan()->delete();

        // Simpan file jika ada
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public'); // Menyimpan file di folder storage/app/public/uploads
        }
    
        // Tambahkan riwayat bimbingan yang baru
        RiwayatBimbingan::create([
            'jadwal_bimbingan_id' => $request->jadwal_bimbingan_id,
            'catatan_dosen' => $request->catatan_dosen, // Catatan dosen
            'catatan_mahasiswa' => $request->catatan_mahasiswa, // Catatan mahasiswa
            'status' => $request->status,
            'file' => $filePath, // Simpan path file jika ada
        ]);

         // Set session flag untuk menunjukkan catatan baru
        session()->flash('edited_riwayat_bimbingan', true);
    
        // Redirect dengan pesan sukses
        return redirect()->route('detail-riwayat', $request->mahasiswa_id)
                         ->with('success', 'Riwayat bimbingan berhasil ditambahkan.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($mahasiswaId)
    {
        // Ambil mahasiswa yang spesifik
        $mahasiswa = Mahasiswa::findOrFail($mahasiswaId);

        // Ambil jadwal bimbingan mahasiswa dengan pagination dan relasi riwayat dan dosen
        $jadwalBimbingans = $mahasiswa->jadwalbimbingan()->with(['riwayatBimbingan', 'dosen'])->paginate(5);

        return view('riwayat_bimbingan.detail', compact('mahasiswa', 'jadwalBimbingans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Kirim data riwayat bimbingan ke view edit
        $riwayatBimbingan = RiwayatBimbingan::findOrFail($id);
        $jadwalBimbingans = JadwalBimbingan::all();
        return view('riwayat_bimbingan.edit', compact('riwayatBimbingan', 'jadwalBimbingans'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
 * Update the specified resource in storage.
 */
    public function update(Request $request, RiwayatBimbingan $riwayatBimbingan)
    {
        // Validasi input
        $request->validate([
            'catatan_dosen' => 'nullable|string',
            'catatan_mahasiswa' => 'nullable|string',
            'status' => 'required|in:Proses,Revisi,ACC',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:5048', // Validasi file (maksimal 5MB)
        ]);

        // Simpan file jika ada
        $filePath = $riwayatBimbingan->file; // Menyimpan file lama jika tidak ada file baru
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada file baru
            if ($filePath) {
                Storage::delete('public/' . $filePath);
            }
            // Simpan file baru
            $filePath = $request->file('file')->store('uploads', 'public');
        }

        // Perbarui data riwayat bimbingan
        $riwayatBimbingan->update([
            // Tidak perlu update 'jadwal_bimbingan_id' karena sudah sesuai dengan data yang ada
            'catatan_dosen' => $request->catatan_dosen,
            'catatan_mahasiswa' => $request->catatan_mahasiswa,
            'status' => $request->status,
            'file' => $filePath,
        ]);

        // Set session flag untuk menunjukkan riwayat bimbingan yang diubah
        session()->flash('edited_riwayat_bimbingan', true);

        // Redirect dengan pesan sukses
        return redirect()->route('detail-riwayat', $riwayatBimbingan->jadwalBimbingan->mahasiswa_id)
                        ->with('success', 'Riwayat bimbingan berhasil diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatBimbingan $riwayatBimbingan)
    {
        //
    }
}
