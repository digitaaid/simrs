<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>
        @yield('title')
    </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="{{ asset('kitasehat/logokitasehat-lingkar.png') }}" rel="icon">
    <link href="{{ asset('kitasehat/logokitasehat-lingkar.png') }}" rel="apple-touch-icon">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('medicio/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    {{-- datepicker --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- Template Main CSS File -->
    <link href="{{ asset('medicio/assets/css/style.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>
    @include('vendor.medico.header')
    <main id="main">
        @yield('content')
        {{ $slot }}
    </main><!-- End #main -->
    @include('vendor.medico.footer')
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="{{ asset('medicio/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('medicio/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('medicio/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('medicio/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('medicio/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('medicio/assets/vendor/php-email-form/validate.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('medicio/assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    {{-- <script src="{{ asset('loading-overlay/loadingoverlay.min.js') }}"></script> --}}
    @yield('js')
</body>

</html>
