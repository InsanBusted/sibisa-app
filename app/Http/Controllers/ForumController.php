<?php

namespace App\Http\Controllers;

use App\Models\ForumDiskusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $forums = ForumDiskusi::with('user')->latest()->paginate(5);
        return view('forums.index', compact('forums'));
    }
    public function index2()
    {
        $forums = ForumDiskusi::with('user')->latest()->paginate(5);
        return view('dashboard.forum-diskusi', compact('forums'));
    }
    public function index3()
    {
        $forums = ForumDiskusi::with('user')->latest()->paginate(5);
        return view('dosen.dosen.forum-diskusi', compact('forums'));
    }


    public function search(Request $request)
    {
        $search = $request->input('search');
        $forums = ForumDiskusi::where('title', 'like', "%$search%")
        ->orWhereHas('user', function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->paginate(5);

        // Cek apakah data dosen ditemukan
    if ($forums->isEmpty()) {
        // Anda bisa menampilkan pesan jika tidak ada data
        $message = 'Data forum tidak ditemukan';
    } else {
        $message = null; // Tidak ada pesan jika data ditemukan
    }

        return view('forums.index', compact('forums', 'message'));
    }
    public function search2(Request $request)
    {
        $search = $request->input('search');
        $forums = ForumDiskusi::where('title', 'like', "%$search%")
        ->orWhereHas('user', function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->paginate(5);

        // Cek apakah data dosen ditemukan
    if ($forums->isEmpty()) {
        // Anda bisa menampilkan pesan jika tidak ada data
        $message = 'Data forum tidak ditemukan';
    } else {
        $message = null; // Tidak ada pesan jika data ditemukan
    }

        return view('dashboard.forum-diskusi', compact('forums', 'message'));
    }
    public function search3(Request $request)
    {
        $search = $request->input('search');
        $forums = ForumDiskusi::where('title', 'like', "%$search%")
        ->orWhereHas('user', function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })
        ->paginate(5);

        // Cek apakah data dosen ditemukan
    if ($forums->isEmpty()) {
        // Anda bisa menampilkan pesan jika tidak ada data
        $message = 'Data forum tidak ditemukan';
    } else {
        $message = null; // Tidak ada pesan jika data ditemukan
    }

        return view('dosen.dosen.forum-diskusi', compact('forums', 'message'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data dosen berdasarkan ID dan muat relasi jadwalbimbingan
        $forum = ForumDiskusi::with('user')->findOrFail($id);

        // Kirim data forum dan jadwal bimbingan ke view
        return view('forums.detail', compact('forum'));
    }
    public function show2($id)
    {
        // Ambil data dosen berdasarkan ID dan muat relasi jadwalbimbingan
        $forum = ForumDiskusi::with('user')->findOrFail($id);

        // Kirim data forum dan jadwal bimbingan ke view
        return view('dashboard.detail-forum', compact('forum'));
    }
    public function show3($id)
    {
        // Ambil data dosen berdasarkan ID dan muat relasi jadwalbimbingan
        $forum = ForumDiskusi::with('user')->findOrFail($id);

        // Kirim data forum dan jadwal bimbingan ke view
        return view('dosen.dosen.detail-forum', compact('forum'));
    }
    
    public function create()
    {
        return view('forums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ];

        

        ForumDiskusi::create($data);
        return redirect()->route('forum');
    }
    public function store2(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ];

        

        ForumDiskusi::create($data);
        return redirect()->route('forum-mahasiswa');
    }
    public function store3(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ];

        

        ForumDiskusi::create($data);
        return redirect()->route('forum-dosen');
    }

    public function update(Request $request, ForumDiskusi $forum)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ];

        

        $forum->update($data);
        return redirect()->route('forum');
    }
    public function update2(Request $request, ForumDiskusi $forum)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ];
    
        $forum->update($data);
    
        // Redirect ke detail forum mahasiswa dengan ID forum
        return redirect()->route('detail-forum-mahasiswa', ['id' => $forum->id])
            ->with('success', 'Forum berhasil diperbarui.');
    }
    public function update3(Request $request, ForumDiskusi $forum)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        $data = [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ];
    
        $forum->update($data);
    
        // Redirect ke detail forum mahasiswa dengan ID forum
        return redirect()->route('detail-forum-dosen', ['id' => $forum->id])
            ->with('success', 'Forum berhasil diperbarui.');
    }
    

    public function destroy(ForumDiskusi $forum)
    {
        $forum->delete();
        return redirect()->route('forum')->with('danger', 'Berhasil menghapus data!');
    }
}
