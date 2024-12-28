@extends('admin.layouts.app')

@section('content')


    @role('admin|mahasiswa')
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <!-- Detail Forum -->
        <h2>{{ $forum->title }}</h2>
        <hr>
        <p class="fs-3 text-white">{{ $forum->content }}</p>
        <hr>
        <p class="fs-6">Ditulis oleh: {{ $forum->user->name }}</p>

        <!-- Tombol Edit -->
        @if (Auth::id() === $forum->user_id)
            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                data-bs-target="#editforum{{ $forum->id }}">
                Edit Forum
            </button>
        @endif

        <!-- Modal Edit -->
        @if (Auth::id() === $forum->user_id)
            <div class="modal fade" id="editforum{{ $forum->id }}">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Forum</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('edit-forum-mahasiswa', $forum->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group mb-3">
                                    <label for="title">Judul Forum</label>
                                    <input type="text" class="form-control" id="title" name="title" required
                                        value="{{ old('title', $forum->title) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="content">Isi Forum</label>
                                    <textarea class="form-control" id="content" name="content" rows="4" required>{{ old('content', $forum->content) }}</textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <hr>

        <!-- Form Tambah Reply -->
        <h4>Tambahkan Balasan</h4>
        <form action="{{ route('add-reply-mahasiswa', $forum->id) }}" method="POST">
            @csrf
            <textarea name="content" class="form-control mb-3 border" rows="3" placeholder="Tulis Balasan Anda..."></textarea>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>

        <hr>

        <!-- List Balasan -->
        @if ($forum->replies->count() > 0)
            <h4>Balasan</h4>
            @foreach ($forum->replies as $reply)
                <div class="mb-3 border-bottom pb-2">
                    <p>{{ $reply->content }}</p>
                    <small>Oleh: {{ $reply->user->name }} | {{ $reply->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        @endif
    @endrole
@endsection
