<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\JadwalBimbingan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class JadwalBimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalBimbingan = JadwalBimbingan::with('mahasiswa', 'dosen')->orderBy('id', 'asc')->paginate(5);
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        // dd($jadwalBimbingan);
        return view('dashboard.index', compact('jadwalBimbingan', 'dosen', 'mahasiswa'));
    }

    // MENU SEARCH
    public function search(Request $request)
    {
        $search = $request->input('search');

        $jadwalBimbingan = JadwalBimbingan::where('tanggal', 'like', "%$search%")
            ->orWhere('jam', 'like', "%$search%")
            ->orWhereHas('dosen', function ($query) use ($search) {
                $query->where('nama', 'like', "%$search%");
            })
            ->orWhereHas('mahasiswa', function ($query) use ($search) {
                $query->where('nama', 'like', "%$search%");
            })
            ->paginate(10); // Sesuaikan jumlah pagination

        // Cek apakah data dosen ditemukan
    if ($jadwalBimbingan->isEmpty()) {
        // Anda bisa menampilkan pesan jika tidak ada data
        $message = 'Data Jadwal ' . $search . ' tidak ditemukan';
    } else {
        $message = null; // Tidak ada pesan jika data ditemukan
    }

        return view('dashboard', compact('jadwalBimbingan', 'message'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
            'dosen_id' => 'required|exists:dosens,id',
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'status' => 'required|in:Pending,Disetujui,Ditolak',
            ]);

        $data = [
            'tanggal' => $request->input('tanggal'),
            'jam' => $request->input('jam'),
            'dosen_id' => $request->input('dosen_id'),
            'mahasiswa_id' => $request->input('mahasiswa_id'),
            'status' => $request->input('status'),
        ];

        JadwalBimbingan::create($data);
        return redirect()->route('dashboard')->with('success', 'Berhasil Menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalBimbingan $jadwalBimbingan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalBimbingan $jadwalBimbingan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalBimbingan $jadwalbimbingan)
    {
        $request->validate([
            'tanggal' => 'required',
            'jam' => 'required',
            'status' => 'required',
        ]);
    
        $data = [
            'tanggal' => $request->input('tanggal'),
            'jam' => $request->input('jam'),
            'status' => $request->input('status'),
        ];
    
        $jadwalbimbingan->update($data);
    
        return redirect()->route('dashboard')->with('success', 'Berhasil mengubah data!');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalBimbingan $jadwalbimbingan)
    {
        $jadwalbimbingan->delete();
        return redirect()->route('dashboard')->with('danger', 'Berhasil menghapus data!');
    }
}
