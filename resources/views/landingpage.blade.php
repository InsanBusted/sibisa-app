<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="icon" href="img/favicon.png" type="image/png" />
    <title>SIBISA</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}" />
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('vendors/owl-carousel/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('vendors/nice-select/css/nice-select.css')}}" />
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
  </head>

  <body>
    <!--================ Start Header Menu Area =================-->
    <header class="header_area">
      <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="{{route('beranda')}}"
              >
                <h2 class="text-primary-sibisa"> SIBISA APP</h2>
            </a>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="icon-bar"></span> <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div
              class="collapse navbar-collapse offset"
              id="navbarSupportedContent"
            >
              <ul class="nav navbar-nav menu_nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('login')}}">Login</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!--================ End Header Menu Area =================-->

    <!--================ Start Home Banner Area =================-->
    <section class="home_banner_area">
      <div class="banner_inner">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="banner_content text-center">
                <p class="text-uppercase">
                  Ayo Bimbingan, Keluarga menunggu anda wisuda!
                </p>
                <h2 class="text-uppercase mt-4 mb-5">
                  Selangkah lagi menuju Wisuda  
                </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ Start Feature Area =================-->
    <section class="feature_area section_gap_top">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3">Fitur Utama</h2>
              <p>
                Fitur yang akan membantu anda mengatur jadwal bimbingan.
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <div class="icon"><span class="flaticon-student"></span></div>
              <div class="desc">
                <h4 class="mt-3 mb-2">Jadwal Bimbingan</h4>
                <p>
                    Fitur ini memungkinkan mahasiswa untuk mengajukan atau mengubah jadwal bimbingan sesuai kebutuhan melalui sistem kalender yang terintegrasi. Pengajuan akan dikirimkan ke dosen untuk disetujui, dan notifikasi otomatis akan menginformasikan perubahan. Riwayat jadwal tercatat untuk mempermudah monitoring dan menghindari benturan waktu.
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <div class="icon"><span class="flaticon-book"></span></div>
              <div class="desc">
                <h4 class="mt-3 mb-2">Riwayat Bimbingan</h4>
                <p>
                    Fitur ini memberikan akses kepada mahasiswa untuk meninjau catatan bimbingan sebelumnya, termasuk saran dan revisi dari dosen. Riwayat ini memudahkan mahasiswa dalam merencanakan langkah selanjutnya. Semua data tersimpan terstruktur untuk referensi kapan saja.
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="single_feature">
              <div class="icon"><span class="flaticon-earth"></span></div>
              <div class="desc">
                <h4 class="mt-3 mb-2">Forum Diskusi</h4>
                <p>
                    Forum diskusi memungkinkan mahasiswa mengajukan pertanyaan terkait tugas akhir dan mendapatkan jawaban dari dosen atau mahasiswa lain. Diskusi tersimpan sebagai referensi dan mempercepat penyelesaian masalah tanpa menunggu bimbingan. Fitur ini mendorong kolaborasi aktif dalam menemukan solusi.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    

    <!--================ Start footer Area  =================-->
    <footer class="bg-dark text-center py-3"><i>Copyright &copy; 2024 SIBISA APP</i></footer>
    <!--================ End footer Area  =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('vendors/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/owl-carousel-thumb.min.js')}}"></script>
    <script src="{{asset('js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('js/mail-script.js')}}"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="{{asset('js/gmaps.min.js')}}"></script>
    <script src="{{asset('js/theme.js')}}"></script>
  </body>
</html>
