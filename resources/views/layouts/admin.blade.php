<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="robots" content="all,follow">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} Dashboard</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/vendor/bootstrap-file-input/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/summernote/summernote-bs4.min.css') }}">
    @yield('style')
</head>
<body id="page-top">
<div id="app">
    <div id="wrapper">
        @include('partial.backend.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('partial.backend.navbar')
                <!-- End of Topbar -->
                <div class="container-fluid">
                    @include('partial.backend.flash')
                    @yield('content')

                </div>
            </div>
            @include('partial.backend.footer')
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('partial.backend.modal')
</div>
<script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('backend/js/custom.js') }}"></script>
<script src="{{ asset('backend/vendor/bootstrap-file-input/js/plugins/piexif.js') }}"></script>
<script src="{{ asset('backend/vendor/bootstrap-file-input/js/plugins/sortable.min.js') }}"></script>
<script src="{{ asset('backend/vendor/bootstrap-file-input/js/fileinput.min.js') }}"></script>
<script src="{{ asset('backend/vendor/bootstrap-file-input/themes/fa5/theme.min.js') }}"></script>
<script src="{{ asset('backend/vendor/summernote/summernote-bs4.min.js') }}"></script>
@yield('script')

</body>
</html>
