<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Login') | Catatan Qu - KSOP Tg. Pinang</title>

    <!-- Google Font: Source Sans 3 -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte-v4/css/bootstrap-icons.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte-v4/css/overlayscrollbars.min.css') }}">

    <!-- AdminLTE v4 CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte-v4/css/adminlte.min.css') }}">

    <style>
        :root {
            --ksop-navy-dark: #07233b;
            --ksop-navy-mid: #0b4971;
            --ksop-teal: #119ba7;
            --ksop-teal-light: #20c5d2;
            --ksop-accent: #f59e0b;
        }

        body.login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 10% 20%, #e2eaf2 0%, #edf3f9 50%, #e6eff7 100%);
            font-family: 'Source Sans 3', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            padding: 20px 14px;
        }

        .login-modern-container {
            width: min(980px, 100%);
            margin: auto;
        }

        .login-modern-card {
            display: grid;
            grid-template-columns: 44% 56%;
            border-radius: 22px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 25px 65px -12px rgba(9, 39, 66, 0.22),
                        0 0 0 1px rgba(15, 62, 103, 0.06);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        /* Brand Panel (Left) */
        .login-brand-panel {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px 42px;
            color: #ffffff;
            background: linear-gradient(150deg, var(--ksop-navy-dark) 0%, var(--ksop-navy-mid) 58%, var(--ksop-teal) 100%);
            overflow: hidden;
        }

        /* Background nautical aura */
        .login-brand-panel::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(32, 197, 210, 0.25) 0%, transparent 70%);
            pointer-events: none;
        }

        .login-brand-panel::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(11, 73, 113, 0.4) 0%, transparent 70%);
            pointer-events: none;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: #e0f6f8;
            margin-bottom: 22px;
        }

        .brand-logo-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 72px;
            height: 72px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 10px 24px rgba(4, 25, 43, 0.28);
            padding: 10px;
            margin-bottom: 20px;
        }

        .brand-logo-wrap img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .brand-title {
            font-size: 28px;
            font-weight: 800;
            line-height: 1.2;
            margin: 0 0 14px;
            color: #ffffff;
            letter-spacing: -0.01em;
        }

        .brand-title span {
            color: #4ee0ec;
            display: block;
            font-size: 22px;
            font-weight: 600;
            margin-top: 4px;
        }

        .brand-copy {
            color: rgba(255, 255, 255, 0.82);
            font-size: 14px;
            line-height: 1.65;
            margin: 0;
            font-weight: 400;
        }

        .brand-features {
            list-style: none;
            padding: 0;
            margin: 24px 0 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .brand-features li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.9);
        }

        .brand-features li i {
            color: #4ee0ec;
            font-size: 15px;
        }

        .brand-footer {
            position: relative;
            z-index: 2;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.14);
            font-size: 12px;
            color: rgba(255, 255, 255, 0.72);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand-footer .tag-v4 {
            background: rgba(255, 255, 255, 0.15);
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 11px;
        }

        /* Form Panel (Right) */
        .login-form-panel {
            padding: 48px 46px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }

        .form-header-title {
            color: #0c2842;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 6px;
            letter-spacing: -0.01em;
        }

        .form-header-subtitle {
            color: #6c7c8c;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .input-group-modern {
            margin-bottom: 20px;
        }

        .input-group-modern .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #243c52;
            margin-bottom: 6px;
            display: block;
        }

        .input-group-modern .input-group {
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(10, 30, 50, 0.03);
            transition: all .2s ease;
        }

        .input-group-modern .form-control {
            height: 48px;
            font-size: 14px;
            border: 1px solid #d9e2ec;
            border-right: none;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
            padding: 10px 14px;
            color: #172d3f;
            background-color: #fafbfc;
            transition: all .2s ease;
        }

        .input-group-modern .form-control:focus {
            background-color: #ffffff;
            border-color: #119ba7;
            box-shadow: none;
        }

        .input-group-modern .input-group:focus-within {
            box-shadow: 0 0 0 3px rgba(17, 155, 167, 0.15);
        }

        .input-group-modern .input-group-text {
            background-color: #fafbfc;
            border: 1px solid #d9e2ec;
            border-left: none;
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
            color: #8294a5;
            padding: 0 16px;
            font-size: 16px;
            cursor: pointer;
            transition: color .2s ease, background-color .2s ease;
        }

        .input-group-modern .form-control:focus + .input-group-text,
        .input-group-modern .input-group-text:focus-within {
            border-color: #119ba7;
            background-color: #ffffff;
            color: #119ba7;
        }

        .btn-ksop-login {
            height: 48px;
            background: linear-gradient(105deg, #0b5482 0%, #1094a1 100%);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: .02em;
            box-shadow: 0 10px 22px rgba(16, 148, 161, 0.28);
            transition: all .25s ease;
        }

        .btn-ksop-login:hover {
            transform: translateY(-1px);
            background: linear-gradient(105deg, #094770 0%, #0d838f 100%);
            box-shadow: 0 14px 28px rgba(16, 148, 161, 0.35);
            color: #ffffff;
        }

        .btn-ksop-login:active {
            transform: translateY(1px);
        }

        .form-check-label {
            font-size: 13px;
            color: #556779;
            user-select: none;
        }

        .form-check-input:checked {
            background-color: #119ba7;
            border-color: #119ba7;
        }

        .invalid-feedback {
            font-size: 12px;
            font-weight: 500;
            margin-top: 5px;
            display: block;
        }

        /* Fallback for regular auth cards (Register, Reset, Confirm) */
        .standard-auth-box {
            width: min(520px, 100%);
            margin: auto;
        }

        @media (max-width: 860px) {
            .login-modern-card {
                grid-template-columns: 1fr;
                border-radius: 18px;
            }

            .login-brand-panel {
                padding: 34px 28px;
            }

            .brand-logo-wrap {
                width: 58px;
                height: 58px;
                margin-bottom: 14px;
            }

            .brand-title {
                font-size: 24px;
            }

            .brand-features {
                display: none;
            }

            .brand-footer {
                display: none;
            }

            .login-form-panel {
                padding: 34px 26px;
            }
        }
    </style>
</head>

<body class="login-page @yield('body-class')">
    <div class="login-modern-container">
        @hasSection('full-card')
            @yield('full-card')
        @else
            <div class="card shadow-lg border-0 rounded-4 p-4 standard-auth-box">
                <div class="text-center mb-3">
                    @yield('logo')
                </div>
                @yield('content')
            </div>
        @endif
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="{{ asset('vendor/adminlte-v4/js/bootstrap.bundle.min.js') }}"></script>

    <!-- OverlayScrollbars JS -->
    <script src="{{ asset('vendor/adminlte-v4/js/overlayscrollbars.browser.es6.min.js') }}"></script>

    <!-- AdminLTE v4 JS -->
    <script src="{{ asset('vendor/adminlte-v4/js/adminlte.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
