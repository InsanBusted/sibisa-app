<?php
use App\Notifications\JadwalBimbingan;

?>

@extends('admin.layouts.app')
@section('content')

    @role('admin|mahasiswa')
    <div class="row">
        <div class="col-md-12">
            <h1>FORUM DISKUSI</h1>
        </div>
    </div>
        <div class="row">
            <div class="col-12 mt-3">
                <!--Todo List Wrapper Start-->
                <div class="todo-list-wrapper">

                    <!--Todo List Container Start-->
                    <div class="todo-list-container">
                        <!--Add Todo List Start-->
                        <div class="head p-3">
                            {{-- TAMBAH FORUM --}}
                            <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                                data-bs-target="#exampleModal3">
                                <i class="fa fa-plus-circle"></i>
                                Buat Forum
                            </button>
                            {{-- modal tambah forum --}}
                            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah forum</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('add-forum') }}" method="post">
                                                @csrf
                                                <div class="row mbn-15">
                                                    <div class="col-12 mb-15">
                                                        <input type="text" class="form-control" name="title"
                                                            placeholder="Masukkan Judul Forum">
                                                    </div>
                                                    <div class="col-12 mb-15">
                                                        <input type="text" class="form-control" name="content"
                                                            placeholder="Masukkan Content">
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-secondary"
                                                data-bs-dismiss="modal">BATAL</button>
                                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--Todo List Search Start-->
                        <div class="todo-list-search">
                            <form action="{{ route('search-forum') }}" method="get">
                                <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                <input type="search" name="search" placeholder="Cari Forum">
                            </form>
                        </div>
                        <!--Todo List Search End-->

                        <!--Todo List Start-->
                        <ul class="todo-list">
                            @foreach ($forums as $forum)
                                <li>
                                    <div class="list-content px-5 py-3">
                                        <h3><a href="{{ route('detail-forum', $forum->id) }}"
                                                class="text-decoration-none text-white">{{ $forum->title }}</a></h3>
                                                <p>Author : {{$forum->user->name}}</p>
                                        <span class="time fs-6">Tanggal:
                                            {{ \Carbon\Carbon::parse($forum->created_at)->format('d-m-Y') }}</span>
                                    </div>
                                    {{-- delete forum --}}
                                    <div class="list-action px-5 right ">
                                        <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#deleteforum{{ $forum->id }}">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </div>
                                    {{-- Modal Hapus --}}
                                    <div class="modal fade mt-5" id="deleteforum{{ $forum->id }}" tabindex="-1"
                                        aria-labelledby="deleteforumLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteforumLabel">HAPUS DATA</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Anda yakin ingin menghapus data ini?</p>
                                                </div>
                                                <form action="{{ route('delete-forum', $forum->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                </li>
                            @endforeach
                        </ul>
                        <!--Todo List End-->
                        <div class="px-5 py-3">
                            {{$forums->links()}}
                        </div>

                        <!--Add Todo List End-->

                    </div>
                    <!--Todo List Container End-->

                </div>
                <!--Todo List Wrapper End-->
            </div>
        </div>
    @endrole

@endsection
