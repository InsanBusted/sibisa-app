<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::paginate(5);
        $prodi = Prodi::all();

        // Cek apakah data mahasiswa ditemukan
        if ($mahasiswa->isEmpty()) {
            // Anda bisa menampilkan pesan jika tidak ada data
            $message = 'Data mahasiswa tidak ditemukan';
        } else {
            $message = null; // Tidak ada pesan jika data ditemukan
        }

        return view('mahasiswa.index', compact('mahasiswa', 'prodi', 'message'));
    }

    public function index2()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $mahasiswa->load('prodi');

        return view('dashboard.mahasiswa', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $prodi = Prodi::all();
        $mahasiswa = Mahasiswa::where('nama', 'like', "%$search%")
            ->orWhere('nim', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->orWhereHas('prodi', function ($query) use ($search) {
                $query->where('nama', 'like', "%$search%");
            })
            ->paginate(5);

        // Cek apakah data mahasiswa ditemukan
        if ($mahasiswa->isEmpty()) {
            // Anda bisa menampilkan pesan jika tidak ada data
            $message = 'Data mahasiswa tidak ditemukan';
        } else {
            $message = null; // Tidak ada pesan jika data ditemukan
        }

        return view('mahasiswa.index', compact('prodi', 'mahasiswa', 'message'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|min:3|max:50',
                'email' => 'required|min:3',
                'nim' => 'required|min:3|max:50',
                'prodi_id' => 'required',
            ],
            [
                'nama.required' => 'Nama Mahasiswa Wajib Diisi',
                'nama.min' => 'Nama Mahasiswa Minimal 3 Karakter',
                'nama.max' => 'Nama Mahasiswa Maksimal 50 Karakter',
                'email.required' => 'Email Wajib Diisi',
                'email.email' => 'Email Tidak Valid',
                'email.unique' => 'Email Sudah Terdaftar',
                'nim.required' => 'NIM Wajib Diisi',
                'nim.min' => 'NIM Minimal 3 Karakter',
                'nim.max' => 'NIM Maksimal 50 Karakter',
                'nim.unique' => 'NIM Sudah Terdaftar',
                'prodi_id.required' => 'Prodi Wajib Dipilih',
                'prodi_id.exists' => 'Prodi Tidak Valid',
            ]
        );

        // Buat User baru
        $user = User::create([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')) // Default password
        ]);

        // Berikan role mahasiswa
        $user->assignRole('mahasiswa');

        // Buat data Mahasiswa
        $data = [
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'prodi_id' => $request->input('prodi_id'),
            'user_id' => $user->id,
        ];

        Mahasiswa::create($data);
        return redirect()->route('mahasiswa')->with('success', 'berhasil menambahkan data!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate(
            [
                'nama' => 'required|min:3|max:50',
                'email' => 'required|min:3',
                'nim' => 'required|min:3|max:50',
                'prodi_id' => 'required',
            ],
            [
                'nama.required' => 'Nama Mahasiswa Wajib Diisi',
                'nama.min' => 'Nama Mahasiswa Minimal 3 Karakter',
                'nama.max' => 'Nama Mahasiswa Maksimal 50 Karakter',
                'email.required' => 'Email Wajib Diisi',
                'email.email' => 'Email Tidak Valid',
                'email.unique' => 'Email Sudah Terdaftar',
                'nim.required' => 'NIM Wajib Diisi',
                'nim.min' => 'NIM Minimal 3 Karakter',
                'nim.max' => 'NIM Maksimal 50 Karakter',
                'nim.unique' => 'NIM Sudah Terdaftar',
                'prodi_id.required' => 'Prodi Wajib Dipilih',
                'prodi_id.exists' => 'Prodi Tidak Valid',
            ]
        );

        // Perbarui data User terkait
        $mahasiswa->user->update([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
        ]);

        // Perbarui data Mahasiswa
        $data = [
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'prodi_id' => $request->input('prodi_id'),
        ];

        $mahasiswa->update($data);
        return redirect()->route('prodi')->with('success', 'Berhasil mengubah data!');
    }

    // detail
    public function show($id)
    {
        // Ambil data dosen berdasarkan ID dan muat relasi jadwalbimbingan
        $mahasiswa = Mahasiswa::with('jadwalbimbingan')->findOrFail($id);

        // Kirim data mahasiswa dan jadwal bimbingan ke view
        return view('mahasiswa.detail', compact('mahasiswa'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa')->with('danger', 'Berhasil menghapus data!');
    }
}
