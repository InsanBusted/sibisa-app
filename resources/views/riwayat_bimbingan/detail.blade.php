@extends('admin.layouts.app')


@section('content')
    <h1>
        Riwayat Bimbingan untuk Mahasiswa: {{ $mahasiswa->nama }}</h1>

    <div class="box">
        <div class="box-head">
            <h4 class="title">Daftar Riwayat Bimbingan</h4>
            {{-- @if ($message)
                <div class="mt-2 alert alert-danger">{{ $message }}</div>
            @endif --}}
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-vertical-middle table-selectable">

                    <!-- Table Head Start -->
                    <thead>
                        <tr class="text-white">
                            <th>No</th>
                            <!--<th class="selector h5"><button class="button-check"></button></th>-->
                            <th><span>JADWAL BIMBINGAN</span></th>
                            <th><span>CATATAN</span></th>
                            <th><span>STATUS</span></th>
                            <th><span>DOKUMEN</span></th>
                            <th><span>AKSI</span></th>
                            <th></th>
                        </tr>
                    </thead><!-- Table Head End -->

                    <!-- Table Body Start -->
                    <tbody>
                        @if ($mahasiswa->jadwalbimbingan->isNotEmpty())
                            @foreach ($mahasiswa->jadwalbimbingan as $jadwal)
                                @php
                                    // Cek apakah ada riwayat bimbingan dengan catatan dosen atau catatan mahasiswa
                                    $hasNotes = $jadwal->riwayatBimbingan->contains(function ($riwayat) {
                                        return $riwayat->catatan_dosen || $riwayat->catatan_mahasiswa;
                                    });
                                @endphp
                    
                                @if ($hasNotes) <!-- Hanya tampilkan jadwal yang ada riwayat bimbingannya dengan catatan -->
                                    <tr class="text-white">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>Tanggal Bimbingan:</strong> {{ $jadwal->tanggal }}
                                            (Dosen: {{ $jadwal->dosen->nama }})
                                        </td>
                    
                                        @foreach ($jadwal->riwayatBimbingan as $riwayat)
                                            @if ($riwayat->catatan_dosen || $riwayat->catatan_mahasiswa)
                                                <td>
                                                    <strong>Catatan Dosen:</strong> {{ $riwayat->catatan_dosen }}<br>
                                                    <strong>Catatan Mahasiswa:</strong> {{ $riwayat->catatan_mahasiswa }}
                                                    @if(session('edited_riwayat_bimbingan'))
                                                        <span class="text-muted">(edited)</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($riwayat->status == 'Proses')
                                                        <span class="badge badge-warning">{{ $riwayat->status }}</span>
                                                    @elseif ($riwayat->status == 'Revisi')
                                                        <span class="badge badge-danger">{{ $riwayat->status }}</span>
                                                    @elseif ($riwayat->status == 'ACC')
                                                        <span class="badge badge-success">{{ $riwayat->status }}</span>
                                                    @endif
                                                </td>
                    
                                                <!-- Menampilkan file jika ada -->
                                                @if($riwayat->file)
                                                    <td>
                                                        <a href="{{ asset('storage/' . $riwayat->file) }}" target="_blank">Lihat File</a>
                                                    </td>
                                                @else
                                                    <td>Tidak ada file yang diunggah.</td>
                                                @endif
                                                <!-- Tombol Edit -->
                                                <td>
                                                    <a href="{{ route('edit-riwayat', $riwayat->id) }}" class="btn btn-warning btn-sm">Edit</a> <!-- Tombol edit -->
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <p>Tidak ada jadwal bimbingan untuk mahasiswa ini.</p>
                        @endif
                    </tbody>
                    
                    
                    
                </table>
                {{ $jadwalBimbingans->links() }}
            </div>
        </div>
    </div>

    <h2>Tambah Riwayat Bimbingan Baru</h2>
    <form action="{{ route('add-riwayat') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
        
        <div class="mb-3">
            <label for="catatan_dosen">Catatan Dosen</label>
            <input name="catatan_dosen" id="catatan_dosen" class="form-control">
    
        <div class="mb-3">
            <label for="catatan_mahasiswa">Catatan Mahasiswa</label>
            <input name="catatan_mahasiswa" id="catatan_mahasiswa" class="form-control">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">File (Gambar/Docx/Pdf) Max 5MB</label>
            <input name="file" class="form-control" type="file" id="formFile" accept=".jpg,.jpeg,.png,.pdf,.docx">
        </div>
    
        <div class="mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="Proses">Proses</option>
                <option value="Revisi">Revisi</option>
                <option value="ACC">ACC</option>
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    
@endsection
