<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>@yield('title')</title>
    <!-- CSS -->

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('dashboard/img/brand/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    {{-- <link rel="stylesheet" href="{{ asset('dashboard/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
        type="text/css"> --}}
    <!-- Page plugins -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Argon CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('dashboard/css/argon.css?v=1.2.0') }}" type="text/css"> --}}


</head>

<body>
    <!-- Sidenav -->
    @include('layouts.argon_nav')
    <!-- Main content -->
    <div class="main-content" id="panel">
        @yield('content')
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('dashboard/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <!-- Optional JS -->
    <script src="{{ asset('dashboard/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/chart.js/dist/Chart.extension.js') }}"></script>
    <!-- Argon JS -->
    <script src="{{ asset('dashboard/js/argon.js?v=1.2.0') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    @yield('scripts')

</body>

</html>
