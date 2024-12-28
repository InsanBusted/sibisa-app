<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\ForumDiskusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(Request $request, $forumId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Reply::create([
            'forum_id' => $forumId,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Reply berhasil ditambahkan');
    }
    public function store2(Request $request, $forumId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Reply::create([
            'forum_id' => $forumId,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Reply berhasil ditambahkan');
    }
    public function store3(Request $request, $forumId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Reply::create([
            'forum_id' => $forumId,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Reply berhasil ditambahkan');
    }
}
