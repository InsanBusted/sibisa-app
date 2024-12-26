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

                        <!--Mail-->
                        <li class="adomx-dropdown col-auto">
                            <a class="toggle" href="#"><i class="zmdi zmdi-email-open"></i><span class="badge"></span></a>

                            <!-- Dropdown -->
                            <div class="adomx-dropdown-menu dropdown-menu-mail">
                                <div class="head">
                                    <h4 class="title">You have 3 new mail.</h4>
                                </div>
                                <div class="body custom-scroll">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <div class="image"><img src="assets/images/avatar/avatar-2.jpg" alt=""></div>
                                                <div class="content">
                                                    <h6>Sub: New Account</h6>
                                                    <p>There are many variations of passages of Lorem Ipsum available. </p>
                                                </div>
                                                <span class="reply"><i class="zmdi zmdi-mail-reply"></i></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="image"><img src="assets/images/avatar/avatar-1.jpg" alt=""></div>
                                                <div class="content">
                                                    <h6>Sub: Mail Support</h6>
                                                    <p>There are many variations of passages of Lorem Ipsum available. </p>
                                                </div>
                                                <span class="reply"><i class="zmdi zmdi-mail-reply"></i></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="image"><img src="assets/images/avatar/avatar-2.jpg" alt=""></div>
                                                <div class="content">
                                                    <h6>Sub: Product inquiry</h6>
                                                    <p>There are many variations of passages of Lorem Ipsum available. </p>
                                                </div>
                                                <span class="reply"><i class="zmdi zmdi-mail-reply"></i></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="image"><img src="assets/images/avatar/avatar-1.jpg" alt=""></div>
                                                <div class="content">
                                                    <h6>Sub: Mail Support</h6>
                                                    <p>There are many variations of passages of Lorem Ipsum available. </p>
                                                </div>
                                                <span class="reply"><i class="zmdi zmdi-mail-reply"></i></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </li>

                        <!--Notification-->
                        <li class="adomx-dropdown col-auto">
                            <a class="toggle" href="#"><i class="zmdi zmdi-notifications"></i><span class="badge"></span></a>

                            <!-- Dropdown -->
                            <div class="adomx-dropdown-menu dropdown-menu-notifications">
                                <div class="head">
                                    <h5 class="title">You have 4 new notification.</h5>
                                </div>
                                <div class="body custom-scroll">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="zmdi zmdi-notifications-none"></i>
                                                <p>There are many variations of pages available.</p>
                                                <span>11.00 am   Today</span>
                                            </a>
                                            <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="zmdi zmdi-block"></i>
                                                <p>There are many variations of pages available.</p>
                                                <span>11.00 am   Today</span>
                                            </a>
                                            <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="zmdi zmdi-info-outline"></i>
                                                <p>There are many variations of pages available.</p>
                                                <span>11.00 am   Today</span>
                                            </a>
                                            <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="zmdi zmdi-shield-security"></i>
                                                <p>There are many variations of pages available.</p>
                                                <span>11.00 am   Today</span>
                                            </a>
                                            <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="zmdi zmdi-notifications-none"></i>
                                                <p>There are many variations of pages available.</p>
                                                <span>11.00 am   Today</span>
                                            </a>
                                            <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="zmdi zmdi-block"></i>
                                                <p>There are many variations of pages available.</p>
                                                <span>11.00 am   Today</span>
                                            </a>
                                            <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="zmdi zmdi-info-outline"></i>
                                                <p>There are many variations of pages available.</p>
                                                <span>11.00 am   Today</span>
                                            </a>
                                            <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="zmdi zmdi-shield-security"></i>
                                                <p>There are many variations of pages available.</p>
                                                <span>11.00 am   Today</span>
                                            </a>
                                            <button class="delete"><i class="zmdi zmdi-close-circle-o"></i></button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="footer">
                                    <a href="#" class="view-all">view all</a>
                                </div>
                            </div>

                        </li>

                        <!--User-->
                        <li class="adomx-dropdown col-auto">
                            <a class="toggle" href="#">
                                <h3 class="name">{{ Auth::user()->name }}</h3>
                            </a>

                            <!-- Dropdown -->
                            <div class="adomx-dropdown-menu dropdown-menu-user">
                                <div class="head">
                                    <h5 class="name"><a href="#">Madison Howard</a></h5>
                                    <a class="mail" href="#">mailnam@mail.com</a>
                                </div>
                                <div class="body">
                                    <ul>
                                        <li><a href="#"><i class="zmdi zmdi-account"></i>Profile</a></li>
                                        <li><a href="#"><i class="zmdi zmdi-email-open"></i>Inbox</a></li>
                                        <li><a href="#"><i class="zmdi zmdi-wallpaper"></i>Activity</a></li>
                                    </ul>
                                    <ul>
                                        <li><a href="#"><i class="zmdi zmdi-settings"></i>Setting</a></li>
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
                                    <ul>
                                        <li><a href="#"><i class="zmdi zmdi-paypal"></i>Payment</a></li>
                                        <li><a href="#"><i class="zmdi zmdi-google-pages"></i>Invoice</a></li>
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

@role('mahasiswa|dosen')
<nav class="navbar navbar-expand-lg navbar-white bg-white text-dark p-3" >
    <div class="container-fluid align-items-center">
        <!-- Logo -->
        <div class="d-flex align-items-center">
            <h2 class=""><a href="{{ route('dashboard') }}" class="text-decoration-none text-primary-sibisa">
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
                    <a class="nav-link text-dark active" href="#">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="#">Jadwal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="#">Riwayat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="#">Forum</a>
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
