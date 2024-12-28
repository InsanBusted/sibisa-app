@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Riwayat Bimbingan</h1>

    <form action="{{ route('update-riwayat-mahasiswa', $riwayatBimbingan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="catatan_dosen">Catatan Dosen</label>
            <textarea name="catatan_dosen" id="catatan_dosen" class="form-control">{{ old('catatan_dosen', $riwayatBimbingan->catatan_dosen) }}</textarea>
        </div>

        <div class="form-group">
            <label for="catatan_mahasiswa">Catatan Mahasiswa</label>
            <textarea name="catatan_mahasiswa" id="catatan_mahasiswa" class="form-control">{{ old('catatan_mahasiswa', $riwayatBimbingan->catatan_mahasiswa) }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Proses" {{ $riwayatBimbingan->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                <option value="Revisi" {{ $riwayatBimbingan->status == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                <option value="ACC" {{ $riwayatBimbingan->status == 'ACC' ? 'selected' : '' }}>ACC</option>
            </select>
        </div>

        <div class="form-group">
            <label for="file">File</label>
            <input type="file" name="file" id="file" class="form-control">
            @if ($riwayatBimbingan->file)
                <p>File saat ini: <a href="{{ asset('storage/' . $riwayatBimbingan->file) }}" target="_blank">Lihat File</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
