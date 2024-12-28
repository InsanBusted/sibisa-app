@extends('admin.layouts.app')

@section('content')


    @role('admin')
        <div class="row">
            <div class="col-12 mb-30">
                <div class="box">
                    <div class="box-head">
                        <h4 class="title">Daftar Dosen</h4>
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal3">
                                    <i class="fa fa-plus-circle"></i>
                                    Tambah Dosen
                                </button>
                            </div>
                            {{-- SEARCH BAR --}}
                            <div class="col-6">
                                <form action="{{route('search-dosen')}}" method="get">
                                    <div class="input-group rounded">
                                        <input type="search" class="form-control rounded" name="search" id="search-bar"
                                            placeholder="Cari Berdasarkan Nama, NIP, Email, Prodi" aria-label="Search"
                                            aria-describedby="search-addon" />
                                        <button type="submit" class="input-group-text border-0">
                                            <i class="zmdi zmdi-search zmdi-hc-fw"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if($message)
                            <div class="alert alert-danger">{{ $message }}</div>
                        @endif
                        @if (session('danger'))
                            <div class="alert alert-danger">
                                {{ session('danger') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
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
                                        <th><span>NAMA</span></th>
                                        <th><span>NIP</span></th>
                                        <th><span>EMAIL</span></th>
                                        <th><span>Aksi</span></th>
                                        <th></th>
                                    </tr>
                                </thead><!-- Table Head End -->


                                <!-- Table Body Start -->
                                <tbody>
                                    @foreach ($dosen as $d)
                                        <tr class="text-white">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->nama }}</td>
                                            <td>{{ $d->nip }}</td>
                                            <td>{{ $d->email }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editdosen{{ $d->id }}">Edit</button>
                                                    {{-- modal edit --}}
                                                <div class="modal fade" id="editdosen{{ $d->id }}">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Dosen</h5>
                                                                <button class="close" data-bs-dismiss="modal"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('edit-dosen', $d->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="row mbn-15 mt-2">
                                                                        <div class="col-12 mb-15">
                                                                            <input type="text" class="form-control"
                                                                                name="nama" placeholder="Nama Dosen" required
                                                                                value="{{ old('nama', $d->nama) }}">
                                                                        </div>
                                                                        <div class="col-12 mb-15">
                                                                            <input type="text" class="form-control"
                                                                                name="nip" placeholder="Nip Dosen" required
                                                                                value="{{ old('nip', $d->nip) }}">
                                                                        </div>
                                                                        <div class="col-12 mb-15">
                                                                            <input type="text" class="form-control"
                                                                                name="email" placeholder="Email Dosen"
                                                                                required value="{{ old('email', $d->email) }}">
                                                                        </div>
                                                                        <div class="col-12 mb-15">
                                                                            <select class="form-control" name="prodi_id">
                                                                                <option hidden>Pilih Prodi</option>
                                                                                @foreach ($prodi as $p)
                                                                                    <option value="{{ $p->id }}"
                                                                                        {{ $p->id == $d->prodi_id ? 'selected' : '' }}
                                                                                        required>{{ $p->nama }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="button button-warning"
                                                                    data-bs-dismiss="modal">Kembali</button>
                                                                <button type="submit"
                                                                    class="button button-success">Edit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- detail --}}
                                                <a href="{{ route('detail-dosen', $d->id) }}" class="btn btn-primary">Detail</a>
                                                {{-- delete --}}
                                                <button type="button" class="button button-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deletedosen{{ $d->id }}">Hapus</button>
                                                {{-- modal hapus --}}
                                                <div class="modal fade" id="deletedosen{{ $d->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">HAPUS DOSEN</h5>
                                                                <button class="close" data-bs-dismiss="modal"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Anda Yakin Ingin Menghapus Dosen Ini?</p>
                                                            </div>
                                                            <form action="{{ route('delete-dosen', $d->id) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <div class="modal-footer">
                                                                    <button type="button" class="button button-danger"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="button button-primary">Hapus</button>
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
                            {{ $dosen->links() }}


                            {{-- modal tambah dosen --}}
                            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Dosen</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('add-dosen') }}" method="post">
                                                @csrf
                                                <div class="row mbn-15">
                                                    <div class="col-12 mb-15">
                                                        <input type="text" class="form-control" name="nama"
                                                            placeholder="Nama">
                                                    </div>
                                                    <div class="col-12 mb-15">
                                                        <input type="text" class="form-control" name="nip"
                                                            placeholder="NIP">
                                                    </div>
                                                    <div class="col-12 mb-15">
                                                        <input type="email" class="form-control" name="email"
                                                            placeholder="Email">
                                                    </div>
                                                    <div class="col-12 mb-15">
                                                        <select class="form-control" name="prodi_id">
                                                            <option hidden>Pilih Prodi</option>
                                                            @foreach ($prodi as $p)
                                                                <option value="{{ $p->id }}">{{ $p->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12 mb-15">
                                                        <input type="password" class="form-control" name="password" placeholder="password" required>
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
                    </div>
                </div>
            </div>




        </div>
    @endrole
@endsection
