<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SIBISA - DASHBOARD</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo/logo-tab.png">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/cryptocurrency-icons.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/plugins.css')}}">

    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/helper.css')}}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
    



</head>

<body class="skin-dark">

    <div class="main-wrapper">


        <!-- Header Section Start -->
        <div class="header-section">
            @include("admin.layouts.header")
        </div><!-- Header Section End -->
        <!-- Side Header Start -->
        <div class="side-header show">
            <button class="side-header-close"><i class="zmdi zmdi-close"></i></button>
            <!-- Side Header Inner Start -->
            @include("admin.layouts.side-header")
        </div><!-- Side Header End -->

        <!-- Content Body Start -->
        <div class="content-body">

            @yield("content")

        </div><!-- Content Body End -->

        <!-- Footer Section Start -->
        <div class="footer-section">
            @include("admin.layouts.footer")
        </div><!-- Footer Section End -->

    </div>

    <!-- JS
============================================ -->

    <!-- Global Vendor, plugins & Activation JS -->
    <script src="{{asset('assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap.min.js')}}"></script>
    <!--Plugins JS-->
    <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/tippy4.min.js.js')}}"></script>
    <!--Main JS-->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>

    <!-- Plugins & Activation JS For Only This Page -->

    <!--Moment-->
    <script src="{{asset('assets/js/plugins/moment/moment.min.js')}}"></script>

    <!--Daterange Picker-->
    <script src="{{asset('assets/js/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/js/plugins/daterangepicker/daterangepicker.active.js')}}"></script>

    <!--Echarts-->
    <script src="{{asset('assets/js/plugins/chartjs/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/chartjs/chartjs.active.js')}}"></script>

    <!--VMap-->
    <script src="{{asset('assets/js/plugins/vmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/vmap/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('assets/js/plugins/vmap/maps/samples/jquery.vmap.sampledata.js')}}"></script>
    <script src="{{asset('assets/js/plugins/vmap/vmap.active.js')}}"></script>

    
</body>

</html>