@extends('admin.layouts.app')

@section('content')
    @php
        // Filter jadwal bimbingan sesuai dengan mahasiswa yang sedang login jika user adalah mahasiswa
        $jadwalBimbingans = Auth::user()->hasRole('dosen')
            ? $jadwalBimbingans->where('dosen_id', Auth::user()->dosen->id)
            : $jadwalBimbingans; // Admin dapat melihat semua jadwal
    @endphp

    @role('admin|dosen')
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="row justify-content-center">
                    <div class="col-12 mb-30">
                        <div class="box">
                            <div class="box-head">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <h4 class="title">Riwayat Bimbingan</h4>
                                    </div>
                                </div>

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

                            <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal"
                                data-bs-target="#tambahJadwalModal">
                                Buat Riwayat Bimbingan
                            </button>

                            <div class="modal fade" id="tambahJadwalModal" tabindex="-1"
                                aria-labelledby="tambahJadwalModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahJadwalModalLabel">Buat Riwayat Bimbingan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('add-riwayat-dosen') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="dosen_id" value="{{ $dosen->id }}">

                                                <div class="mb-3">
                                                    <label for="jadwal_bimbingan_id">Jadwal Bimbingan</label>
                                                    <select name="jadwal_bimbingan_id" id="jadwal_bimbingan_id"
                                                        class="form-control">
                                                        <option value="" disabled selected>Pilih Jadwal Bimbingan</option>
                                                        @foreach ($jadwalBimbingans as $jadwal)
                                                            <option value="{{ $jadwal->id }}">{{ $jadwal->tanggal }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="catatan_dosen">Catatan Dosen</label>
                                                    <input name="catatan_dosen" id="catatan_dosen" class="form-control">
                                                </div>

                                                <div class="mb-3 d-none">
                                                    <label for="catatan_mahasiswa">Catatan Mahasiswa</label>
                                                    <input name="catatan_mahasiswa" id="catatan_mahasiswa" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">File (Gambar/Docx/Pdf) Max
                                                        5MB</label>
                                                    <input name="file" class="form-control" type="file" id="formFile"
                                                        accept=".jpg,.jpeg,.png,.pdf,.docx">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="Proses">Proses</option>
                                                        <option value="Revisi">Revisi</option>
                                                            <option value="ACC">ACC</option>
                                                    </select>
                                                </div>

                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Buat Riwayat</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-vertical-middle table-selectable">
                                        <!-- Table Head Start -->
                                        <thead>
                                            <tr class="text-white">
                                                <th>No</th>
                                                <th><span>JADWAL BIMBINGAN</span></th>
                                                <th><span>DOSEN</span></th>
                                                <th><span>MAHASISWA</span></th>
                                                <th><span>CATATAN</span></th>
                                                <th><span>STATUS</span></th>
                                                <th><span>DOKUMEN</span></th>
                                                <th><span>AKSI</span></th>
                                            </tr>
                                        </thead><!-- Table Head End -->

                                        <!-- Table Body Start -->
                                        <tbody>
                                            @if ($dosen->jadwalbimbingan->isNotEmpty())
                                                @foreach ($dosen->jadwalbimbingan as $jadwal)
                                                    @php
                                                        // Cek apakah ada riwayat bimbingan dengan catatan dosen atau catatan mahasiswa
                                                        $hasNotes = $jadwal->riwayatBimbingan->contains(function (
                                                            $riwayat,
                                                        ) {
                                                            return $riwayat->catatan_dosen ||
                                                                $riwayat->catatan_mahasiswa;
                                                        });
                                                    @endphp

                                                    @if ($hasNotes)
                                                        <!-- Hanya tampilkan jadwal yang ada riwayat bimbingannya dengan catatan -->
                                                        <tr class="text-white">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $jadwal->tanggal }}</td>
                                                            <td>{{ $jadwal->dosen->nama }}</td>
                                                            <td>{{ $jadwal->mahasiswa->nama }}</td>

                                                            @foreach ($jadwal->riwayatBimbingan as $riwayat)
                                                                @if ($riwayat->catatan_dosen || $riwayat->catatan_mahasiswa)
                                                                    <td>
                                                                        <strong>Catatan Dosen:</strong>
                                                                        {{ $riwayat->catatan_dosen }}<br>
                                                                        <strong>Catatan Mahasiswa:</strong>
                                                                        {{ $riwayat->catatan_mahasiswa }}
                                                                        @if (session('edited_riwayat_bimbingan'))
                                                                            <span class="text-muted">(edited)</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($riwayat->status == 'Proses')
                                                                            <span
                                                                                class="badge badge-warning">{{ $riwayat->status }}</span>
                                                                        @elseif ($riwayat->status == 'Revisi')
                                                                            <span
                                                                                class="badge badge-danger">{{ $riwayat->status }}</span>
                                                                        @elseif ($riwayat->status == 'ACC')
                                                                            <span
                                                                                class="badge badge-success">{{ $riwayat->status }}</span>
                                                                        @endif
                                                                    </td>

                                                                    <!-- Menampilkan file jika ada -->
                                                                    @if ($riwayat->file)
                                                                        <td>
                                                                            <a href="{{ asset('storage/' . $riwayat->file) }}"
                                                                                target="_blank">Lihat File</a>
                                                                        </td>
                                                                    @else
                                                                        <td>Tidak ada file yang diunggah.</td>
                                                                    @endif

                                                                    <!-- Tombol Edit -->
                                                                    <td>
                                                                        <button type="button" class="btn btn-warning"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#editriwayat{{ $riwayat->id }}">Edit</button>
                                                                        </td>
                                                                        @endif
                                                                        <!-- Edit Modal -->
                                                                        <div class="modal fade"
                                                                            id="editriwayat{{ $riwayat->id }}" tabindex="-1"
                                                                            aria-labelledby="editjadwalLabel{{ $riwayat->id }}"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                    <div
                                                                                        class="modal-header text-white bg-dark">
                                                                                        <h5 class="modal-title"
                                                                                            id="editjadwalLabel{{ $riwayat->id }}">
                                                                                            Edit
                                                                                            Riwayat</h5>
                                                                                        <button type="button"
                                                                                            class="btn-close text-white"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body ">
                                                                                        <form
                                                                                            action="{{ route('edit-riwayat-dosen', $riwayat->id) }}"
                                                                                            method="post" enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            @method('put')
                                                                                            <div class="row mb-3 mt-2">
                                                                                                <div class="col-12 mb-3">
                                                                                                    <label for="catatan_dosen">Catatan Dosen</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control bg-white text-dark"
                                                                                                        name="catatan_dosen" required
                                                                                                        value="{{ old('catatan_dosen', $riwayat->catatan_dosen) }}">
                                                                                                </div>
                                                                                                <div class="col-12 mb-3">
                                                                                                    <label for="catatan_mahasiswa">Catatan Mahasiswa</label>
                                                                                                    <input type="text"
                                                                                                           class="form-control bg-white text-dark"
                                                                                                           name="catatan_mahasiswa" 
                                                                                                           value="{{ old('catatan_mahasiswa', $riwayat->catatan_mahasiswa ?: 'Mahasiswa belum memberikan catatan') }}" readonly>
                                                                                                </div>
                                                                                                    <div class="col-12 mb-3">
                                                                                                        <label
                                                                                                            for="status">Status</label>
                                                                                                        <select
                                                                                                            class="form-control bg-white text-dark"
                                                                                                            name="status"
                                                                                                            required>
                                                                                                            <option value="Proses"
                                                                                                                {{ $riwayat->status == 'Proses' ? 'selected' : '' }}>
                                                                                                                Proses</option>
                                                                                                            <option
                                                                                                                value="Revisi"
                                                                                                                {{ $riwayat->status == 'Revisi' ? 'selected' : '' }}>
                                                                                                                Revisi</option>
                                                                                                                @role('dosen')
                                                                                                            <option value="ACC"
                                                                                                                {{ $riwayat->status == 'ACC' ? 'selected' : '' }}>
                                                                                                                ACC</option>
                                                                                                                @endrole
                                                                                                        </select>
                                                                                                    </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="file">Dokumen</label>
                                                                                                    <input type="file" name="file" id="file" class="form-control">
                                                                                                    @if ($riwayat->file)
                                                                                                        <p>File saat ini: <a href="{{ asset('storage/' . $riwayat->file) }}" target="_blank">Lihat File</a></p>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary text-white"
                                                                                                data-bs-dismiss="modal">Kembali</button>
                                                                                            <button type="submit"
                                                                                                class="btn btn-success">Edit</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                            @endforeach
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6">Tidak ada jadwal bimbingan untuk mahasiswa ini.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    {{-- {{ $jadwalBimbingans->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endrole
@endsection
