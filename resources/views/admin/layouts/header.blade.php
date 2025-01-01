@role('admin')
<div class="container-fluid">
    <div class="row justify-content-between align-items-center">

        <!-- Header Logo (Header Left) Start -->
        <div class="header-logo col-auto">
            <h1 class="text-white"><a href="{{route('dashboard')}}"><i>SIBISA <span class="text-warning">APP</span></i></a></h1>
            {{-- <a href="index.html">
                <img src="assets/images/logo/logoheader.png" alt="">
                <img src="assets/images/logo/logoheader.png" class="logo-light" alt="">
            </a> --}}
        </div><!-- Header Logo (Header Left) End -->

        <!-- Header Right Start -->
        <div class="header-right flex-grow-1 col-auto">
            <div class="row justify-content-between align-items-center">

                <!-- Side Header Toggle & Search Start -->
                <div class="col-auto">
                    <div class="row align-items-center">

                        <!--Side Header Toggle-->
                        <div class="col-auto"><button class="side-header-toggle"><i class="zmdi zmdi-menu"></i></button></div>
                    </div>
                </div><!-- Side Header Toggle & Search End -->

                <!-- Header Notifications Area Start -->
                <div class="col-auto">

                    <ul class="header-notification-area">

                        
                        <!--User-->
                        <li class="adomx-dropdown col-auto">
                            <a class="toggle" href="#">
                                <h3 class="name">{{ Auth::user()->name }}</h3>
                            </a>

                            <!-- Dropdown -->
                            <div class="adomx-dropdown-menu dropdown-menu-user">
                                <div class="head">
                                    <h5 class="name"><a href="#">{{ Auth::user()->name }}</a></h5>
                                    <a class="mail" href="#">{{ Auth::user()->email }}</a>
                                </div>
                                <div class="body">
                                    <ul>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <a :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </li>

                    </ul>

                </div><!-- Header Notifications Area End -->

            </div>
        </div><!-- Header Right End -->

    </div>
</div>
@endrole
{{-- @php
$mahasiswa = $mahasiswa ?? null; // Ambil mahasiswa pertama dari koleksi
@endphp --}}

@role('mahasiswa')
<nav class="navbar navbar-expand-lg navbar-white bg-white text-dark p-3" >
    <div class="container-fluid align-items-center">
        <!-- Logo -->
        <div class="d-flex align-items-center">
            <h2 class=""><a href="{{ route('index-mahasiswa') }}" class="text-decoration-none text-primary-sibisa">
               <i> SIBISA APP</i>
            </a></h2>
        </div>

        <!-- Hamburger Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-dark active" href="{{ route('index-mahasiswa') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="{{route('dashboard-mahasiswa')}}">Jadwal</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link text-dark " href="{{route('riwayat-mahasiswa')}}">Riwayat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="{{route('forum-mahasiswa')}}">Forum</a>
                </li>
            </ul>
        </div>

        <!-- Profile Section -->
    <div class="d-flex align-items-center dropdown">
        <a 
            href="#" 
            class="text-dark fw-bold dropdown-toggle" 
            id="profileDropdown" 
            role="button" 
            data-bs-toggle="dropdown" 
            aria-expanded="false">
            <span class="fa fa-user-circle"></span> {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item text-danger" type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </div>
    </div>
</nav>
@endrole
@role('dosen')
<nav class="navbar navbar-expand-lg navbar-white bg-white text-dark p-3" >
    <div class="container-fluid align-items-center">
        <!-- Logo -->
        <div class="d-flex align-items-center">
            <h2 class=""><a href="{{ route('index-dosen') }}" class="text-decoration-none text-primary-sibisa">
               <i> SIBISA APP</i>
            </a></h2>
        </div>

        <!-- Hamburger Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-dark active" href="{{ route('index-dosen') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="{{route('dashboard-dosen')}}">Jadwal</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link text-dark " href="{{route('riwayat-dosen')}}">Riwayat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="{{route('forum-dosen')}}">Forum</a>
                </li>
            </ul>
        </div>

        <!-- Profile Section -->
    <div class="d-flex align-items-center dropdown">
        <a 
            href="#" 
            class="text-dark fw-bold dropdown-toggle" 
            id="profileDropdown" 
            role="button" 
            data-bs-toggle="dropdown" 
            aria-expanded="false">
            <span class="fa fa-user-circle"></span> {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item text-danger" type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </div>
    </div>
</nav>
@endrole
@guest
<nav class="navbar navbar-expand-lg navbar-white bg-white text-dark p-3" >
    <div class="container-fluid align-items-center justify-content-center">
        <!-- Logo -->
        <div class="d-flex align-items-center">
            <h2 class=""><a href="#" class="text-decoration-none text-primary-sibisa">
               <i> SIBISA APP</i>
            </a></h2>
        </div>
    </div>
</nav>
@endguest