@extends("admin.layouts.app")

@section("content")


@role('admin')
<div class="row">
    <div class="col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h4 class="title">Daftar Mahasiswa</h4>
                <div class="row">
                    <div class="col 6">
                        <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                            <i class="fa fa-plus-circle"></i>
                            Tambah Mahasiswa
                        </button>
                    </div>
                    <div class="col-6">
                        <form action="{{route('search-mahasiswa')}}" method="get">
                            <div class="input-group rounded">
                                <input type="search" class="form-control rounded" name="search" id="search-bar"
                                    placeholder="Cari Berdasarkan Nama, NIM, Email, Prodi" aria-label="Search"
                                    aria-describedby="search-addon" />
                                <button type="submit" class="input-group-text border-0">
                                    <i class="zmdi zmdi-search zmdi-hc-fw"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @if($message)
                    <div class="mt-2 alert alert-danger">{{ $message }}</div>
                @endif
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
                        @foreach ($errors->all() as $error )
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
                                <th><span>NIM</span></th>
                                <th><span>EMAIL</span></th>
                                <th><span>PRODI</span></th>
                                <th><span>Aksi</span></th>
                                <th></th>
                            </tr>
                        </thead><!-- Table Head End -->

                        <!-- Table Body Start -->
                        <tbody>
                            @foreach ($mahasiswa as $mhs)
                            <tr class="text-white">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$mhs->nama}}</td>
                                <td>{{$mhs->nim}}</td>
                                <td>{{$mhs->email}}</td>
                                <td>{{$mhs->prodi->nama}}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editmhs{{ $mhs->id }}">Edit</button>
                                    {{-- modal edit --}}
                                    <div class="modal fade" id="editmhs{{ $mhs->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Mahasiswa</h5>
                                                    <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('edit-mahasiswa', $mhs->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row mbn-15 mt-2">
                                                            <div class="col-12 mb-15">
                                                                <input type="text" class="form-control" name="nim" placeholder="NIM Mahasiswa" required value="{{ old('nim', $mhs->nim) }}">
                                                            </div>
                                                            <div class="col-12 mb-15">
                                                                <input type="text" class="form-control" name="nama" placeholder="Nama Mahasiswa" required value="{{ old('nama', $mhs->nama) }}">
                                                            </div>
                                                            <div class="col-12 mb-15">
                                                                <input type="text" class="form-control" name="email" placeholder="Email Mahasiswa" required value="{{ old('email', $mhs->email) }}">
                                                            </div>
                                                            <div class="col-12 mb-15">
                                                                <select class="form-control" name="prodi_id">
                                                                    <option hidden>Pilih Prodi</option>
                                                                    @foreach ($prodi as $p)
                                                                        <option value="{{ $p->id }}" {{ $p->id == $mhs->prodi_id ? 'selected' : '' }} required>{{ $p->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="button button-warning" data-bs-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="button button-success">Edit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- modal detail --}}
                                    <a href="{{ route('detail-mahasiswa', $mhs->id) }}" class="btn btn-primary">Detail</a>
                                    {{-- modal delete --}}
                                    <button type="button" class="button button-danger" data-bs-toggle="modal" data-bs-target="#deletemahasiswa{{ $mhs->id }}">Hapus</button>
                                    <div class="modal fade" id="deletemahasiswa{{ $mhs->id }}">
                                        <div class="modal-dialog">
                                           <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title">HAPUS MAHASISWA</h5>
                                                 <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                              </div>
                                              <div class="modal-body">
                                                 <p>Anda Yakin Ingin Menghapus Prodi Ini?</p>
                                              </div>
                                              <form action="{{ route('delete-mahasiswa', $mhs->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-footer">
                                                    <button type="button" class="button button-danger" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="button button-primary">Hapus</button>
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
                    {{ $mahasiswa->links() }}
                    {{-- modal tambah mahasiswa --}}
                    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('add-mahasiswa')}}" method="post">
                                        @csrf
                                        <div class="row mbn-15">
                                            <div class="col-12 mb-15">
                                                <input type="text" class="form-control" name="nama" placeholder="Nama">
                                            </div>
                                            <div class="col-12 mb-15">
                                                <input type="text" class="form-control" name="nim" placeholder="NIM">
                                            </div>
                                            <div class="col-12 mb-15">
                                                <input type="email" class="form-control" name="email" placeholder="Email">
                                            </div>
                                            <div class="col-12 mb-15">
                                                <select class="form-control" name="prodi_id">
                                                    <option hidden>Pilih Prodi</option>
                                                    @foreach ($prodi as $p)
                                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
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