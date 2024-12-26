@extends('admin.layouts.app')

@section('content')
    @role('mahasiswa')
        <div class="row">
            <div class="col-auto">
                <h1>Mendukung Mahasiswa Dalam <br> Menyelesaikan Tugas Akhir</h1>
                <p class="text-white">
                    Untuk Melihat jadwal bimbingan silahkan klik <a href="{{ route('dashboard-mahasiswa') }}"><span class="text-warning">Disini</span></a>
                </p>
            </div>
        </div>
        <div class="row my-3">
            <h1>Profile Mahasiswa</h1>
            <div class="col-md-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-white">NIM</th>
                            <th scope="col" class="text-white">NAMA</th>
                            <th scope="col" class="text-white">PRODI</th>
                            <th scope="col" class="text-white">EMAIL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="profile-td text-white">{{ $mahasiswa->nim }}</td>
                            <td class="profile-td text-white">{{ $mahasiswa->nama }}</td>
                            <td class="profile-td text-white">{{ $mahasiswa->prodi ? $mahasiswa->prodi->nama : 'Belum Ditentukan' }}</td>
                            <td class="profile-td text-white">{{ $mahasiswa->email }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    @endrole
@endsection
