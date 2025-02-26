<?php

namespace App\Http\Controllers;

use App\Mail\JadwalBimbinganMail;
use App\Models\Dosen;
use App\Models\JadwalBimbingan;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\JadwalBimbingan as JadwalBimbinganNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JadwalBimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Cek peran user yang sedang login
        if ($user->hasRole('mahasiswa')) {
            // Mahasiswa hanya bisa melihat jadwal mereka sendiri
            $jadwalBimbingan = JadwalBimbingan::with('mahasiswa', 'dosen')
                ->where('mahasiswa_id', $user->mahasiswa->id)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            // Dosen/Admin dapat melihat semua jadwal
            $jadwalBimbingan = JadwalBimbingan::with('mahasiswa', 'dosen')
                ->orderBy('id', 'desc')
                ->paginate(5);
        }

        // Ambil data dosen dan mahasiswa
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        
        // dd($jadwalBimbingan);
        return view('dashboard.index', compact('jadwalBimbingan', 'dosen', 'mahasiswa'));
    }
    public function index2()
    {
        $user = Auth::user();

        // Cek peran user yang sedang login
        if ($user->hasRole('dosen')) {
            // Mahasiswa hanya bisa melihat jadwal mereka sendiri
            $jadwalBimbingan = JadwalBimbingan::with('mahasiswa', 'dosen')
                ->where('dosen_id', $user->dosen->id)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            // Dosen/Admin dapat melihat semua jadwal
            $jadwalBimbingan = JadwalBimbingan::with('mahasiswa', 'dosen')
                ->orderBy('id', 'desc')
                ->get();
        }

        // Ambil data dosen dan mahasiswa
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        
        // dd($jadwalBimbingan);
        return view('dosen.dosen.jadwal', compact('jadwalBimbingan', 'dosen', 'mahasiswa'));
    }

    // MENU SEARCH
    public function search(Request $request)
    {
        $search = $request->input('search');
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();

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

        return view('dashboard.index', compact('mahasiswa','dosen','jadwalBimbingan', 'message'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'tanggal' => 'required|date',
        'jam' => 'required',
        'dosen_id' => 'required|exists:dosens,id',
        'mahasiswa_id' => 'required|exists:mahasiswas,id',
        'status' => 'required|in:Pending,Disetujui,Ditolak',
    ]);

    // Simpan data jadwal ke dalam database
    $jadwal = JadwalBimbingan::create([
        'tanggal' => $request->input('tanggal'),
        'jam' => $request->input('jam'),
        'dosen_id' => $request->input('dosen_id'),
        'mahasiswa_id' => $request->input('mahasiswa_id'),
        'status' => $request->input('status'),
    ]);

    // Ambil data pengguna (dosen dan mahasiswa) berdasarkan ID
    $dosenUser = User::where('id', $jadwal->dosen->user_id)->first();
    $mahasiswaUser = User::where('id', $jadwal->mahasiswa->user_id)->first();

    // Kirim email ke dosen yang dipilih dan admin
    Mail::to($dosenUser->email)->send(new JadwalBimbinganMail($jadwal));
    Mail::to($mahasiswaUser->email)->send(new JadwalBimbinganMail($jadwal));
    Mail::to('insanbusted@gmail.com')->send(new JadwalBimbinganMail($jadwal));

    // Redirect dengan pesan sukses
    return redirect()->route('dashboard')->with('success', 'Berhasil Menambahkan data dan Notifikasi serta Email Terkirim!');
}

    public function store2(Request $request)
    {
        // Validasi data
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
            'dosen_id' => 'required|exists:dosens,id',
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'status' => 'required|in:Pending,Disetujui,Ditolak',
        ]);

        // Simpan data jadwal ke dalam database
        $jadwal = JadwalBimbingan::create([
            'tanggal' => $request->input('tanggal'),
            'jam' => $request->input('jam'),
            'dosen_id' => $request->input('dosen_id'),
            'mahasiswa_id' => $request->input('mahasiswa_id'),
            'status' => $request->input('status'),
        ]);

        // Ambil data pengguna (dosen dan mahasiswa) berdasarkan ID
        $dosenUser = User::where('id', $jadwal->dosen->user_id)->first();
        $mahasiswaUser = User::where('id', $jadwal->mahasiswa->user_id)->first();

        // Kirim email ke dosen yang dipilih dan admin
        Mail::to($dosenUser->email)->send(new JadwalBimbinganMail($jadwal));
        Mail::to($mahasiswaUser->email)->send(new JadwalBimbinganMail($jadwal));
        Mail::to('insanbusted@gmail.com')->send(new JadwalBimbinganMail($jadwal));

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard-mahasiswa')->with('success', 'Berhasil Menambahkan data dan Notifikasi Terkirim!');
    }
    public function store3(Request $request)
    {
        // Validasi data
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
            'dosen_id' => 'required|exists:dosens,id',
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'status' => 'required|in:Pending,Disetujui,Ditolak',
        ]);

        // Simpan data jadwal ke dalam database
        $jadwal = JadwalBimbingan::create([
            'tanggal' => $request->input('tanggal'),
            'jam' => $request->input('jam'),
            'dosen_id' => $request->input('dosen_id'),
            'mahasiswa_id' => $request->input('mahasiswa_id'),
            'status' => $request->input('status'),
        ]);

        // Ambil data pengguna (dosen dan mahasiswa) berdasarkan ID
        $dosenUser = User::where('id', $jadwal->dosen->user_id)->first();
        $mahasiswaUser = User::where('id', $jadwal->mahasiswa->user_id)->first();

        // Kirim email ke dosen yang dipilih dan admin
        Mail::to($dosenUser->email)->send(new JadwalBimbinganMail($jadwal));
        Mail::to($mahasiswaUser->email)->send(new JadwalBimbinganMail($jadwal));
        Mail::to('insanbusted@gmail.com')->send(new JadwalBimbinganMail($jadwal));

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard-dosen')->with('success', 'Berhasil Menambahkan data dan Notifikasi Terkirim!');
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
    public function update2(Request $request, JadwalBimbingan $jadwalbimbingan)
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
    
        return redirect()->route('dashboard-mahasiswa')->with('success', 'Berhasil mengubah data!');
    }
    public function update3(Request $request, JadwalBimbingan $jadwalbimbingan)
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
    
        return redirect()->route('dashboard-dosen')->with('success', 'Berhasil mengubah data!');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalBimbingan $jadwalbimbingan)
    {
        $jadwalbimbingan->delete();
        return redirect()->route('dashboard')->with('danger', 'Berhasil menghapus data!');
    }
    public function destroy2(JadwalBimbingan $jadwalbimbingan)
    {
        $jadwalbimbingan->delete();
        return redirect()->route('dashboard-mahasiswa')->with('danger', 'Berhasil menghapus data!');
    }
    public function destroy3(JadwalBimbingan $jadwalbimbingan)
    {
        $jadwalbimbingan->delete();
        return redirect()->route('dashboard-dosen')->with('danger', 'Berhasil menghapus data!');
    }
}
