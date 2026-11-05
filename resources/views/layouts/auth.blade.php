<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title') </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('template') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template') }}/dist/css/adminlte.min.css">
    <style>
        .login-modern { background: #eef3f8; }
        .login-modern .login-box { width: min(960px, calc(100% - 32px)); }
        .login-modern .login-card { display: grid; grid-template-columns: 42% 58%; overflow: hidden; border: 0; border-radius: 24px; box-shadow: 0 24px 70px rgba(15, 35, 65, .16); }
        .login-modern .login-brand-panel { display: flex; flex-direction: column; justify-content: space-between; padding: 48px 40px; color: #fff; background: linear-gradient(145deg, #082b52 0%, #0c5b8f 58%, #16a0a7 100%); }
        .login-modern .brand-logo { width: 68px; height: 68px; object-fit: contain; padding: 10px; background: rgba(255,255,255,.95); border-radius: 18px; }
        .login-modern .brand-title { margin: 28px 0 12px; font-size: 32px; line-height: 1.15; font-weight: 700; }
        .login-modern .brand-copy { color: rgba(255,255,255,.78); font-size: 15px; line-height: 1.7; }
        .login-modern .brand-footer { color: rgba(255,255,255,.65); font-size: 12px; letter-spacing: .04em; }
        .login-modern .login-form-panel { padding: 48px 54px; background: #fff; }
        .login-modern .login-box-msg { padding: 0; margin: 0 0 30px; color: #17324d; text-align: left; font-size: 28px; font-weight: 700; }
        .login-modern .login-box-msg small { display: block; margin-top: 8px; color: #8190a0; font-size: 14px; font-weight: 400; }
        .login-modern .input-group { margin-bottom: 20px !important; }
        .login-modern .form-control { height: 50px; border: 1px solid #dce5ed; border-right: 0; border-radius: 12px 0 0 12px; color: #17324d; }
        .login-modern .form-control:focus { border-color: #1596a2; box-shadow: 0 0 0 3px rgba(21,150,162,.12); }
        .login-modern .input-group-text { border: 1px solid #dce5ed; border-left: 0; border-radius: 0 12px 12px 0; background: #fff; color: #8a9aaa; }
        .login-modern .btn-login { height: 50px; border: 0; border-radius: 12px; background: linear-gradient(100deg, #0b6695, #10a0a4); box-shadow: 0 10px 22px rgba(13, 133, 157, .24); font-weight: 600; }
        .login-modern .btn-login:hover { transform: translateY(-1px); box-shadow: 0 12px 26px rgba(13, 133, 157, .32); }
        .login-modern .invalid-feedback { display: block; margin-top: 4px; }
        @media (max-width: 700px) { .login-modern .login-card { display: block; } .login-modern .login-brand-panel { padding: 30px; } .login-modern .brand-title { margin-top: 18px; font-size: 26px; } .login-modern .brand-footer { display: none; } .login-modern .login-form-panel { padding: 32px 26px; } }
    </style>
</head>

<body class="hold-transition login-page @yield('body-class')">
    <div class="login-box">
        <div class="card login-card">
            @yield('logo')
            <!-- /.login-logo -->
            @yield('content')
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('template') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template') }}/dist/js/adminlte.min.js"></script>
</body>

</html>
