<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\JadwalBimbingan;
use App\Models\Prodi;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::paginate(8);
        $prodi = Prodi::all();
        if ($dosen->isEmpty()) {
            $message = 'Data dosen tidak ditemukan';
        } else {
            $message = null;
        }
        return view('dosen.index', compact('dosen', 'prodi', 'message',));

    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $prodi = Prodi::all();
        $dosen = Dosen::where('nama', 'like', "%$search%")
        ->orWhere('nip', 'like', "%$search%")
        ->orWhere('email', 'like', "%$search%")
        ->orWhereHas('prodi', function ($query) use ($search) {
            $query->where('nama', 'like', "%$search%");
        })
        ->paginate(5);

        // Cek apakah data dosen ditemukan
    if ($dosen->isEmpty()) {
        // Anda bisa menampilkan pesan jika tidak ada data
        $message = 'Data dosen tidak ditemukan';
    } else {
        $message = null; // Tidak ada pesan jika data ditemukan
    }

        return view('dosen.index', compact('prodi','dosen', 'message'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:50',
            'email' => 'required|min:3',
            'nip' => 'required|min:3|max:50',
            'prodi_id' => 'required',
        ],
        [
            'nama.required' => 'Nama Dosen Wajib Diisi',
            'nama.min' => 'Nama Dosen Minimal 3 Karakter',
            'nama.max' => 'Nama Dosen Maksimal 50 Karakter',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Email Tidak Valid',
            'email.unique' => 'Email Sudah Terdaftar',
            'nip.required' => 'NIP Wajib Diisi',
            'nip.min' => 'NIP Minimal 3 Karakter',
            'nip.max' => 'NIP Maksimal 50 Karakter',
            'nip.unique' => 'NIP Sudah Terdaftar',
            'prodi_id.required' => 'Prodi Wajib Dipilih',
            'prodi_id.exists' => 'Prodi Tidak Valid',
        ]);
        
        $data = [
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'prodi_id' => $request->input('prodi_id'),
        ];

        Dosen::create($data);
        return redirect()->route('dosen')->with('success', 'berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data dosen berdasarkan ID dan muat relasi jadwalbimbingan
        $dosen = Dosen::with('jadwalbimbingan')->findOrFail($id);

        // Kirim data dosen dan jadwal bimbingan ke view
        return view('dosen.detail', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama' => 'required|min:3|max:50',
            'email' => 'required|min:3',
            'nip' => 'required|min:3|max:50',
            'prodi_id' => 'required',
        ],
        [
            'nama.required' => 'Nama Dosen Wajib Diisi',
            'nama.min' => 'Nama Dosen Minimal 3 Karakter',
            'nama.max' => 'Nama Dosen Maksimal 50 Karakter',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Email Tidak Valid',
            'email.unique' => 'Email Sudah Terdaftar',
            'nip.required' => 'NIP Wajib Diisi',
            'nip.min' => 'NIP Minimal 3 Karakter',
            'nip.max' => 'NIP Maksimal 50 Karakter',
            'nip.unique' => 'NIP Sudah Terdaftar',
            'prodi_id.required' => 'Prodi Wajib Dipilih',
            'prodi_id.exists' => 'Prodi Tidak Valid',
        ]);
        
        $data = [
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'prodi_id' => $request->input('prodi_id'),
        ];

        $dosen->update($data);
        return redirect()->route('dosen')->with('success', 'berhasil mengubah data!');
    }

    public function updateDetail(Request $request, JadwalBimbingan $jadwaldetail)
    {
        // Ambil data jadwal berdasarkan ID
        $jadwal = JadwalBimbingan::findOrFail($jadwaldetail->id);
    
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
            'status' => 'required|in:Pending,Disetujui,Ditolak',
        ]);
    
        try {
            // Update data
            $jadwal->update([
                'tanggal' => $request->input('tanggal'),
                'jam' => $request->input('jam'),
                'status' => $request->input('status'),
            ]);
    
            // Redirect ke halaman detail dosen dengan pesan sukses
            return redirect()
                ->route('detail-dosen', ['id' => $jadwal->dosen_id])
                ->with('success', 'Jadwal berhasil diperbarui.');
        } catch (\Exception $e) {
            // Redirect ke halaman detail dosen dengan pesan error
            return redirect()
                ->route('detail-dosen', ['id' => $jadwal->dosen_id])
                ->withInput() // Kembalikan input pengguna
                ->with('error', 'Terjadi kesalahan saat memperbarui jadwal: ' . $e->getMessage());
        }
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosen')->with('danger', 'berhasil menghapus data!');
    }
}
