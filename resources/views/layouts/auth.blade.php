<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Login') | SeAgenda (Semua Agenda)</title>

    <!-- Google Font: Source Sans 3 (AdminLTE v4 Default) -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=fallback">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte-v4/css/bootstrap-icons.min.css') }}">

    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte-v4/css/overlayscrollbars.min.css') }}">

    <!-- AdminLTE v4 CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte-v4/css/adminlte.min.css') }}">
</head>

<body class="login-page bg-body-secondary @yield('body-class')">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="{{ asset('image/logo-perhubungan.png') }}" alt="Logo Perhubungan" style="height: 48px;" class="mb-2">
                <a href="{{ url('/') }}" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover text-decoration-none d-block">
                    <h1 class="mb-0"><b>Se</b>Agenda</h1>
                </a>
                <p class="mb-0 text-muted small">Semua Agenda</p>
            </div>
            <div class="card-body login-card-body">
                @yield('content')
            </div>
        </div>
        <div class="text-center text-muted small mt-3">
            &copy; {{ date('Y') }} <strong>SeAgenda</strong> &bull; Developer: <strong>bangbhe</strong>
        </div>
    </div>

    <!-- OverlayScrollbars JS -->
    <script src="{{ asset('vendor/adminlte-v4/js/overlayscrollbars.browser.es6.min.js') }}"></script>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="{{ asset('vendor/adminlte-v4/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE v4 JS -->
    <script src="{{ asset('vendor/adminlte-v4/js/adminlte.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
