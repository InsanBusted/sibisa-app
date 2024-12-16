@extends('admin.layouts.app')

@section('content')

    @role('admin')
        <div class="row">
            <h1>Forum Diskusi</h1>
            {{-- <a href="{{ route('forums.create') }}">Buat Forum Baru</a> --}}

            @foreach ($forums as $forum)
                <div>
                    <h2>{{ $forum->title }}</h2>
                    <p>{{ $forum->content }}</p>
                    <p>Diposting oleh: {{ $forum->user->name }}</p>
                    {{-- <a href="{{ route('forums.show', $forum) }}">Lihat Balasan</a> --}}
                </div>
            @endforeach
        </div>
    @endrole

@endsection
