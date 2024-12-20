<div class="">
    <nav class="side-header-menu" id="side-header-menu">
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            @role('admin')
            <li><a href="{{ route('mahasiswa') }}">Mahasiswa</a></li>
            <li><a href="{{ route('prodi') }}">Prodi</a></li>
            <li><a href="{{ route('dosen') }}">Dosen</a></li>
            <li><a href="{{ route('forum') }}">Forum Diskusi</a></li>
            <li><a href="{{ route('riwayat') }}">Riwayat</a></li>
            @endrole
        </ul>
    </nav>
</div>