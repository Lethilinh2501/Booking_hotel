<!--
    Item Name: Luxurious - Hotel Booking HTML Template + Admin Dashboard.
    Author: ashishmaraviya
    Version: 2.2.0
    Copyright 2024
	Author URI: https://themeforest.net/user/ashishmaraviya
-->
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from maraviyainfotech.com/projects/luxurious-html-v22/luxurious-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2024 10:26:54 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Best Luxurious Hotel Booking Template.">
    <meta name="keywords"
        content="hotel, booking, business, restaurant, spa, resort, landing, agency, corporate, start up, site design, new business site, business template, professional template, classic, modern">
    <title>Lumora Hotel - Hotel Booking HTML Template + Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="icon" href="{{ asset('themes/client/assets/img/favicons/favicon.png ') }}" type="image/x-icon">

    <!-- Css All Plugins Files -->
    <link rel="stylesheet" href="{{ asset('themes/client/assets/css/vendor/bootstrap.min.css ') }}">
    <link rel="stylesheet" href="{{ asset('themes/client/assets/css/vendor/magnific-popup.css ') }}">
    <link rel="stylesheet" href="{{ asset('themes/client/assets/css/vendor/aos.css ') }}">
    <link rel="stylesheet" href="{{ asset('themes/client/assets/css/vendor/remixicon.css ') }}">
    <link rel="stylesheet" href="{{ asset('themes/client/assets/css/vendor/materialdesignicons.min.css ') }}">
    <link rel="stylesheet" href="{{ asset('themes/client/assets/css/vendor/swiper-bundle.min.css ') }}">
    <link rel="stylesheet" href="{{ asset('themes/client/assets/css/vendor/semantic.min.css ') }}">
    <link rel="stylesheet" href="{{ asset('themes/client/assets/css/vendor/slick.min.css ') }}">

    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('themes/client/assets/css/style.css ') }}">

</head>

<body>
    <!-- Overlay -->
    <div class="overlay"></div>
    <div class="lh-loader">
        <span class="loader"></span>
    </div>

    <!-- Header -->
    @include('client.layouts.header')

    <!-- Mobile-menu -->
    {{-- @include('clients.layout.menu') --}}
{{--     @include('clients.layout.blocks.slider')--}}
    <!-- Hero -->


    <main>
        @yield('content')
    </main>



    {{-- @include('clients.layout.blocks.footer') --}}



    <!-- Plugins JS -->
    <script src="{{ asset('themes/client/assets/js/vendor/jquery.min.js')}}"></script>
    <script src="{{ asset('themes/client/assets/js/vendor/swiper-bundle.min.js')}}"></script>
    <script src="{{ asset('themes/client/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('themes/client/assets/js/vendor/magnific-popup.min.js')}}"></script>
    <script src="{{ asset('themes/client/assets/js/vendor/aos.js')}}"></script>
    <script src="{{ asset('themes/client/assets/js/vendor/semantic.min.js')}}"></script>
    <script src="{{ asset('themes/client/assets/js/vendor/slick.min.js')}}"></script>
    <script src="{{ asset('themes/client/assets/js/vendor/particles.min.js')}}"></script>
    <script src="{{ asset('themes/client/assets/js/vendor/app.js')}}"></script>

    <!-- Main-js -->
    <script src="{{ asset('themes/client/assets/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>


<!-- Mirrored from maraviyainfotech.com/projects/luxurious-html-v22/luxurious-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Dec 2024 10:27:00 GMT -->
</html>
