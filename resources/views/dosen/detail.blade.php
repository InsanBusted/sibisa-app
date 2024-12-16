@extends('admin.layouts.app')

@section('content')


    @role('admin')
            <h1>Detail Dosen</h1>

            <!-- Informasi Dosen -->
            <div class="card bg-dark text-white">
                <div class="card-header">
                    <h5>Informasi Dosen</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $dosen->nama }}</p>
                    <p><strong>NIP:</strong> {{ $dosen->nip }}</p>
                    <p><strong>Email:</strong> {{ $dosen->email }}</p>
                    <p><strong>Prodi:</strong> {{ $dosen->prodi->nama }}</p>
                </div>
            </div>

            <!-- Tabel Jadwal Bimbingan -->
            <h3 class="mt-4">Jadwal Bimbingan</h3>
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dosen->jadwalbimbingan as $jadwal)
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
                                <div class="modal fade" id="editjadwal{{ $jadwal->id }}" tabindex="-1"
                                    aria-labelledby="editjadwalLabel{{ $jadwal->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header text-white bg-dark">
                                                <h5 class="modal-title" id="editjadwalLabel{{ $jadwal->id }}">Edit Jadwal
                                                </h5>
                                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('edit-detail', $jadwal->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="row mb-3 mt-2">
                                                        <div class="col-12 mb-3">
                                                            <input type="date" class="form-control bg-white text-dark"
                                                                name="tanggal" required
                                                                value="{{ old('tanggal', $jadwal->tanggal) }}">
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <input type="time" class="form-control bg-white text-dark"
                                                                name="jam" required value="{{ old('jam', $jadwal->jam) }}">
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="status">Status</label>
                                                            <select class="form-control bg-white text-dark" name="status"
                                                                required>
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
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Kembali</button>
                                                <button type="submit" class="btn btn-success">Edit</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Button -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deletejadwal{{ $jadwal->id }}">Hapus</button>

                                <!-- Delete Modal -->
                                <div class="modal fade mt-5" id="deletejadwal{{ $jadwal->id }}" tabindex="-1"
                                    aria-labelledby="deletejadwalLabel{{ $jadwal->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deletejadwalLabel{{ $jadwal->id }}">HAPUS JADWAL
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda Yakin Ingin Menghapus Jadwal Ini?</p>
                                            </div>
                                            <form action="{{ route('delete-jadwal', $jadwal->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
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
    @endrole
@endsection
