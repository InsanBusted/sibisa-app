@extends("admin.layouts.app")

@section("content")

<div class="row">
    <div class="col-md-6 mb-30">
        <div class="box">
            <div class="box-head">
                <h4 class="title">Tambah Program Studi</h4>
                <form action="{{route('add-prodi')}}" method="post">
                    @csrf
                    <div class="row mbn-15 mt-2">
                        <div class="col-12 mb-15">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Prodi">
                        </div>
                    </div>  
                </div>
                <div class="modal-footer flex gap-2 p-4">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal3">Simpan</button>
                    {{-- modal --}}
                    <div class="modal fade" id="exampleModal3">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambahkan Prodi</h5>
                                    <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Data Sudah Benar?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="button button-danger" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="button button-primary">Tambahkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Daftar Prodi --}}
    <div class="col-md-6 mb-30">
        <div class="box">
            <div class="box-head">
                <h4 class="title">Daftar Prodi</h4>
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
                                <th><span>Nama</span></th>
                                <th><span>Aksi</span></th>
                                <th></th>
                            </tr>
                        </thead><!-- Table Head End -->
    
                        <!-- Table Body Start -->
                        <tbody>
                            @foreach ($prodi as $p)
                            <tr class="text-white">
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $p->nama }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editprodi{{ $p->id }}">Edit</button>
                                    {{-- modal edit --}}
                                    <div class="modal fade" id="editprodi{{ $p->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Prodi</h5>
                                                    <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('edit-prodi', $p->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row mbn-15 mt-2">
                                                            <div class="col-12 mb-15">
                                                                <input type="text" class="form-control" name="nama" placeholder="Nama Prodi" required value="{{ old('nama', $p->nama) }}">
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
                                    <button type="button" class="button button-danger" data-bs-toggle="modal" data-bs-target="#deleteprodi{{ $p->id }}">Hapus</button>
                                    {{-- modal --}}
                                    <div class="modal fade" id="deleteprodi{{ $p->id }}">
                                        <div class="modal-dialog">
                                           <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title">HAPUS PRODI</h5>
                                                 <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                              </div>
                                              <div class="modal-body">
                                                 <p>Anda Yakin Ingin Menghapus Prodi Ini?</p>
                                              </div>
                                              <form action="{{ route('delete-prodi', $p->id) }}" method="post">
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection