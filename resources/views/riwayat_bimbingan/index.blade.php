@extends("admin.layouts.app")

@section("content")


@role('admin')
<div class="row">
    <div class="col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h4 class="title">Daftar Mahasiswa Bimbingan</h4>
                {{-- @if($message)
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
                                <th></th>
                            </tr>
                        </thead><!-- Table Head End -->

                        <!-- Table Body Start -->
                        <tbody>
                            @foreach ($mahasiswas as $mhs)
                            <tr class="text-white">
                                <td>{{$loop->iteration}}</td>
                                <td><a href="{{ route('detail-riwayat', $mhs->id) }}" class="list-group-item list-group-item-action">
                                    {{ $mhs->nama }} - Dosen: {{ $mhs->jadwalbimbingan->first()->dosen->nama }}
                                </a></td>
                            </tr>
                            @endforeach
                        </tbody><!-- Table Body End -->
                    </table>
                    {{ $mahasiswas->links() }}
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endrole
@endsection