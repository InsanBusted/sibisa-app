<div class="">
    <nav class="side-header-menu" id="side-header-menu">
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            @role('admin|mahasiswa')
            <li><a href="{{ route('mahasiswa') }}">Mahasiswa</a></li>
            @endrole
            @role('admin')
            <li><a href="{{ route('prodi') }}">Prodi</a></li>
            @endrole
        </ul>
    </nav>
</div>