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
        <div class="row">
            <h1 class="text-center">Profile Mahasiswa</h1>
            <!-- Tambahkan wrapper table-responsive -->
            <div class="table-responsive  d-flex justify-content-center">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col" class="text-white border border-white">NIM</th>
                            <th scope="col" class="text-white border border-white">NAMA</th>
                            <th scope="col" class="text-white border border-white">PRODI</th>
                            <th scope="col" class="text-white border border-white">EMAIL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="profile-td text-white border border-white">{{ $mahasiswa->nim }}</td>
                            <td class="profile-td text-white border border-white">{{ $mahasiswa->nama }}</td>
                            <td class="profile-td text-white border border-white">{{ $mahasiswa->prodi ? $mahasiswa->prodi->nama : 'Belum Ditentukan' }}</td>
                            <td class="profile-td text-white border border-white">{{ $mahasiswa->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endrole
@endsection
