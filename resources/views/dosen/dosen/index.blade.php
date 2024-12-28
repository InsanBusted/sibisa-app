@extends('admin.layouts.app')

@section('content')
    @role('admin|dosen')
        <div class="row">
            <div class="col-auto">
                <h1>Mendukung dosen Dalam <br> Menyelesaikan Tugas Akhir</h1>
                <p class="text-white">
                    Untuk Melihat jadwal bimbingan silahkan klik <a href="{{ route('dashboard-dosen') }}"><span class="text-warning">Disini</span></a>
                </p>
            </div>
        </div>
        <div class="row">
            <h1 class="text-center">Profile dosen</h1>
            <!-- Tambahkan wrapper table-responsive -->
            <div class="table-responsive  d-flex justify-content-center">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col" class="text-white border border-white">NIP</th>
                            <th scope="col" class="text-white border border-white">NAMA</th>
                            <th scope="col" class="text-white border border-white">PRODI</th>
                            <th scope="col" class="text-white border border-white">EMAIL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="profile-td text-white border border-white">{{ $dosen->nip }}</td>
                            <td class="profile-td text-white border border-white">{{ $dosen->nama }}</td>
                            <td class="profile-td text-white border border-white">{{ $dosen->prodi ? $dosen->prodi->nama : 'Belum Ditentukan' }}</td>
                            <td class="profile-td text-white border border-white">{{ $dosen->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endrole
@endsection
