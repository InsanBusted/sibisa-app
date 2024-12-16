@extends('admin.layouts.app')

@section('content')


    @role('admin')
            <h1>Detail Mahasiswa</h1>

            <!-- Informasi Mahasiswa -->
            <div class="card bg-dark text-white">
                <div class="card-header">
                    <h5>Informasi Mahasiswa</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
                    <p><strong>NIP:</strong> {{ $mahasiswa->nim }}</p>
                    <p><strong>Email:</strong> {{ $mahasiswa->email }}</p>
                    <p><strong>Prodi:</strong> {{ $mahasiswa->prodi->nama }}</p>
                </div>
            </div>

            <!-- Tabel Jadwal Bimbingan -->
            <h3 class="mt-4">Daftar Jadwal Bimbingan</h3>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Dosen</th>
                        <th>Mahasiswa</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa->jadwalbimbingan as $jadwal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jadwal->tanggal }}</td>
                            <td>{{ $jadwal->jam }}</td>
                            <td>{{ optional($jadwal->dosen)->nama }}</td>
                            <td>{{ optional($jadwal->mahasiswa)->nama }}</td>
                            <td>
                                @if ($jadwal->status == 'Pending')
                                    <span class="badge badge-warning">{{ $jadwal->status }}</span>
                                @elseif ($jadwal->status == 'Ditolak')
                                    <span class="badge badge-danger">{{ $jadwal->status }}</span>
                                @elseif ($jadwal->status == 'Disetujui')
                                    <span class="badge badge-success">{{ $jadwal->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    @endrole
@endsection
