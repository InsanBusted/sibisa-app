@extends('admin.layouts.app')

@section('content')
    @php
        $jadwalBimbingan = Auth::user()->hasRole('dosen')
            ? $jadwalBimbingan->where('dosen_id', Auth::user()->dosen->id)
            : $jadwalBimbingan; // Admin dapat melihat semua jadwal
    @endphp

    @role('admin')
        <div class="row">
            <!-- Top Report Start -->
            <div class="col-xlg-3 col-md-6 col-12 mb-30">
                <div class="top-report">

                    <!-- Head -->
                    <div class="head">
                        <h4 class="text-white">Halo {{ Auth::user()->name }}</h4>

                    </div>

                    <!-- Content -->
                    <div class="content">
                        <p class="mt-1">Saat Ini anda berada di halaman Dashboard SIBISA, Ayo Atur jadwal Bimbingan Agar cepat
                            Wisuda...</p>
                    </div>

                    <!-- Footer -->
                    <div class="footer">
                        {{-- <p>92% of unique visitor</p> --}}
                    </div>

                </div>
            </div><!-- Top Report End -->

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12 mb-30">
                        <div class="box">
                            <div class="box-head">
                                <h4 class="title">Tambah Jadwal Bimbingan</h4>
                                <form action="{{ route('add-jadwal') }}" method="post">
                                    @csrf
                                    <div class="row mbn-15 mt-2">
                                        <div class="col-12 mb-15">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control " name="tanggal" required>
                                        </div>
                                        <div class="col-12 mb-15">
                                            <label for="jam">Jam</label>
                                            <input type="time" class="form-control" name="jam" required>
                                        </div>
                                        <div class="col-12 mb-15">
                                            <label for="dosen">Dosen</label>
                                            <select class="form-control select2" name="dosen_id">
                                                <option hidden>Pilih Dosen</option>
                                                @foreach ($dosen as $d)
                                                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mb-15">
                                            <label for="mhs">Mahasiswa</label>
                                            <select class="form-control select2" name="mahasiswa_id">
                                                <option hidden>Pilih Mahasiswa</option>
                                                @foreach ($mahasiswa as $mhs)
                                                    <option value="{{ $mhs->id }}">{{ $mhs->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mb-15">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" required>
                                                <option hidden>Pilih Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Disetujui">Disetujui</option>
                                                <option value="Ditolak">Ditolak</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer flex gap-2 p-4">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal3">Simpan</button>
                                {{-- modal --}}
                                <div class="modal fade" id="exampleModal3">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambahkan Jadwal</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Data Sudah Benar?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="button button-danger"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="button button-primary">Tambahkan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-12 mb-30">
                        <div class="box">
                            <div class="box-head">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <h4 class="title">Jadwal Bimbingan</h4>
                                        <div class="search-bar">
                                            {{-- <form action="{{route('search-jadwal')}}" method="GET"> --}}
                                            <div class="input-group rounded">
                                                <input type="search" class="form-control rounded" name="search"
                                                    id="search-bar" placeholder="Cari Mahasiswa,Dosen" aria-label="Search"
                                                    aria-describedby="search-addon" />
                                                <button type="submit" class="input-group-text border-0">
                                                    <i class="zmdi zmdi-search zmdi-hc-fw"></i>
                                                </button>
                                            </div>
                                            </form>
                                        </div>
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

                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-vertical-middle table-selectable">

                                        <!-- Table Head Start -->
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <!--<th class="selector h5"><button class="button-check"></button></th>-->
                                                <th><span>Tanggal</span></th>
                                                <th><span>Jam</span></th>
                                                <th><span>Dosen Pembimbing</span></th>
                                                <th><span>Mahasiswa</span></th>
                                                <th><span>Status</span></th>
                                                <th><span>Aksi</span></th>
                                                <th></th>
                                            </tr>
                                        </thead><!-- Table Head End -->

                                        <!-- Table Body Start -->
                                        <tbody>
                                            @foreach ($jadwalBimbingan as $jadwal)
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
                                                    <td>
                                                        <!-- Edit Button -->
                                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#editjadwal{{ $jadwal->id }}">Edit</button>

                                                        <!-- Edit Modal -->
                                                        <div class="modal fade" id="editjadwal{{ $jadwal->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="editjadwalLabel{{ $jadwal->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header text-white bg-dark">
                                                                        <h5 class="modal-title"
                                                                            id="editjadwalLabel{{ $jadwal->id }}">Edit
                                                                            Jadwal</h5>
                                                                        <button type="button" class="btn-close text-white"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body ">
                                                                        <form action="{{ route('edit-jadwal', $jadwal->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('put')
                                                                            <div class="row mb-3 mt-2">
                                                                                <div class="col-12 mb-3">
                                                                                    <input type="date"
                                                                                        class="form-control bg-white text-dark"
                                                                                        name="tanggal" required
                                                                                        value="{{ old('tanggal', $jadwal->tanggal) }}">
                                                                                </div>
                                                                                <div class="col-12 mb-3">
                                                                                    <input type="time"
                                                                                        class="form-control bg-white text-dark"
                                                                                        name="jam" required
                                                                                        value="{{ old('jam', $jadwal->jam) }}">
                                                                                </div>
                                                                                <div class="col-12 mb-3">
                                                                                    <label for="status">Status</label>
                                                                                    <select
                                                                                        class="form-control bg-white text-dark"
                                                                                        name="status" required>
                                                                                        <option value="Pending"
                                                                                            {{ $jadwal->status == 'Pending' ? 'selected' : '' }}>
                                                                                            Pending</option>
                                                                                        <option value="Disetujui"
                                                                                            {{ $jadwal->status == 'Disetujui' ? 'selected' : '' }}>
                                                                                            Disetujui</option>
                                                                                        <option value="Ditolak"
                                                                                            {{ $jadwal->status == 'Ditolak' ? 'selected' : '' }}>
                                                                                            Ditolak</option>
                                                                                    </select>
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


                                                        <!-- Delete Button -->
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deletejadwal{{ $jadwal->id }}">Hapus</button>

                                                        <!-- Delete Modal -->
                                                        <div class="modal fade mt-5" id="deletejadwal{{ $jadwal->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="deletejadwalLabel{{ $jadwal->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deletejadwalLabel{{ $jadwal->id }}">HAPUS
                                                                            JADWAL</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Anda Yakin Ingin Menghapus Jadwal Ini?</p>
                                                                    </div>
                                                                    <form action="{{ route('delete-jadwal', $jadwal->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Hapus</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody><!-- Table Body End -->
                                    </table>
                                    {{ $jadwalBimbingan->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6"></div>
            <div class="col-6"></div>
        </div>
    @endrole
    @role('admin|dosen')
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="row justify-content-center">
                    <div class="col-12 mb-30">
                        <div class="box">
                            <div class="box-head">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <h4 class="title">Jadwal Bimbingan</h4>
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
                                Buat Jadwal
                            </button>
                            <div class="modal fade" id="tambahJadwalModal" tabindex="-1"
                                aria-labelledby="tambahJadwalModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahJadwalModalLabel">Buat Jadwal Bimbingan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('add-jadwal-dosen') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="tanggal" class="form-label">Tanggal</label>
                                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jam" class="form-label">Jam</label>
                                                    <input type="time" class="form-control" id="jam" name="jam" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
                                                    <select class="form-select" id="mahasiswa_id" name="mahasiswa_id" required>
                                                        <option value="" disabled selected>Pilih Mahasiswa</option>
                                                        @foreach ($mahasiswa as $mhs)
                                                            <option value="{{ $mhs->id }}">{{ $mhs->nama }} - {{ $mhs->nim }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @role('dosen')
                                                    <!-- Input hidden untuk dosen_id sesuai user login -->
                                                    <input type="hidden" name="dosen_id" value="{{ auth()->user()->dosen->id }}">
                                                @endrole
                                                <div class="col-12 mb-15">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" name="status" required>
                                                        <option hidden>Pilih Status</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Disetujui">Disetujui</option>
                                                        <option value="Ditolak">Ditolak</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                                                </div>
                                            </form>
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive d-flex justify-content-center">
                                    <table class="table table-vertical-middle table-selectable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th><span>Tanggal</span></th>
                                                <th><span>Dosen Pembimbing</span></th>
                                                <th><span>Mahasiswa</span></th>
                                                <th><span>Status</span></th>
                                                <th><span>Aksi</span></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jadwalBimbingan as $jadwal)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $jadwal->tanggal }}</td>
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
                                                    <td>
                                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#editjadwal{{ $jadwal->id }}">Edit</button>
                                                        <!-- Edit Modal -->
                                                        <div class="modal fade" id="editjadwal{{ $jadwal->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="editjadwalLabel{{ $jadwal->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header text-white bg-dark">
                                                                        <h5 class="modal-title"
                                                                            id="editjadwalLabel{{ $jadwal->id }}">Edit
                                                                            Jadwal</h5>
                                                                        <button type="button" class="btn-close text-white"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body ">
                                                                        <form
                                                                            action="{{ route('edit-jadwal-dosen', $jadwal->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('put')
                                                                            <div class="row mb-3 mt-2">
                                                                                <div class="col-12 mb-3">
                                                                                    <input type="date"
                                                                                        class="form-control bg-white text-dark"
                                                                                        name="tanggal" required
                                                                                        value="{{ old('tanggal', $jadwal->tanggal) }}">
                                                                                </div>
                                                                                <div class="col-12 mb-3">
                                                                                    <input type="time"
                                                                                        class="form-control bg-white text-dark"
                                                                                        name="jam" required
                                                                                        value="{{ old('jam', $jadwal->jam) }}">
                                                                                </div>
                                                                                @role('dosen')
                                                                                    <div class="col-12 mb-3">
                                                                                        <label for="status">Status</label>
                                                                                        <select
                                                                                            class="form-control bg-white text-dark"
                                                                                            name="status" required>
                                                                                            <option value="Pending"
                                                                                                {{ $jadwal->status == 'Pending' ? 'selected' : '' }}>
                                                                                                Pending</option>
                                                                                            <option value="Disetujui"
                                                                                                {{ $jadwal->status == 'Disetujui' ? 'selected' : '' }}>
                                                                                                Disetujui</option>
                                                                                            <option value="Ditolak"
                                                                                                {{ $jadwal->status == 'Ditolak' ? 'selected' : '' }}>
                                                                                                Ditolak</option>
                                                                                        </select>
                                                                                    </div>
                                                                                @endrole
                                                                                @role('mahasiswa')
                                                                                <div class="col-12 mb-3">
                                                                                    <label for="status">STATUS</label>
                                                                                    <input type="text"
                                                                                        class="form-control bg-white text-dark"
                                                                                        name="status"
                                                                                        value="{{ $jadwal->status }}"
                                                                                        readonly>
                                                                                    <!-- Menampilkan status yang tidak bisa diubah -->
                                                                                </div>
                                                                                @endrole
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
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deletejadwal{{ $jadwal->id }}">Hapus</button>
                                                            <!-- Delete Modal -->
                                                        <div class="modal fade mt-5" id="deletejadwal{{ $jadwal->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="deletejadwalLabel{{ $jadwal->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deletejadwalLabel{{ $jadwal->id }}">HAPUS
                                                                            JADWAL</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Anda Yakin Ingin Menghapus Jadwal Ini?</p>
                                                                    </div>
                                                                    <form action="{{ route('delete-jadwal-dosen', $jadwal->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Hapus</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endrole
@endsection
