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

    public function destroy(ForumDiskusi $forum)
    {
        $forum->delete();
        return redirect()->route('forum')->with('danger', 'Berhasil menghapus data!');
    }
}
