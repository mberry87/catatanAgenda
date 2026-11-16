<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') | Catatan Qu - KSOP Tg. Pinang</title>

    <!-- Google Font: Source Sans 3 (AdminLTE v4 Standard) -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=fallback">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte-v4/css/bootstrap-icons.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte-v4/css/overlayscrollbars.min.css') }}">

    <!-- AdminLTE v4 CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte-v4/css/adminlte.min.css') }}">

    <!-- DataTables Plugins -->
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Select2 & Themes -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- Date/Time Pickers -->
    <link rel="stylesheet" href="{{ asset('template/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.11/dist/sweetalert2.min.css">

    <!-- FullCalendar -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fullcalendar/main.css') }}">

    <style>
        :root {
            --ksop-navy-dark: #07233b;
            --ksop-navy-mid: #0a3857;
            --ksop-teal: #1098a3;
            --ksop-teal-light: #20c5d2;
            --ksop-bg-soft: #f4f7fb;
        }

        body {
            background-color: var(--ksop-bg-soft);
            font-family: 'Source Sans 3', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        /* App Header / Navbar */
        .app-header {
            background-color: #ffffff !important;
            border-bottom: 1px solid #e8eef5;
            box-shadow: 0 2px 10px rgba(10, 37, 64, 0.04);
            height: 60px;
        }

        .hover-bg:hover {
            background-color: rgba(16, 152, 163, 0.08);
        }

        /* App Sidebar */
        .app-sidebar {
            background: linear-gradient(180deg, #072238 0%, #0a3857 60%, #072034 100%) !important;
            box-shadow: 2px 0 16px rgba(4, 22, 38, 0.15);
        }

        .sidebar-brand {
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .sidebar-brand .brand-link {
            display: flex;
            align-items: center;
            color: #ffffff;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: .02em;
        }

        .sidebar-brand .brand-image {
            width: 36px;
            height: 36px;
            background: #ffffff;
            padding: 3px;
            border-radius: 8px;
            object-fit: contain;
        }

        .sidebar-wrapper {
            padding: 0 8px;
        }

        .user-panel {
            padding: 14px 10px !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .sidebar-menu .nav-item {
            margin-bottom: 4px;
        }

        .sidebar-menu .nav-link {
            border-radius: 10px;
            color: rgba(255, 255, 255, 0.75);
            padding: 10px 14px;
            font-size: 13.5px;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all .2s ease;
        }

        .sidebar-menu .nav-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(100deg, #108c9a 0%, #12608b 100%) !important;
            box-shadow: 0 6px 16px rgba(5, 20, 40, 0.28);
            font-weight: 600;
        }

        .sidebar-menu .nav-link .nav-icon {
            font-size: 17px;
            margin-right: 10px;
            width: 22px;
            text-align: center;
        }

        .sidebar-menu .nav-treeview {
            padding: 4px 0 4px 14px;
            list-style: none;
        }

        .sidebar-menu .nav-treeview .nav-link {
            padding: 8px 12px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.68);
        }

        .sidebar-menu .nav-treeview .nav-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.08);
        }

        .sidebar-menu .nav-treeview .nav-link.active {
            color: #ffffff !important;
            background: rgba(16, 140, 154, 0.45) !important;
            box-shadow: none;
        }

        .sidebar-menu .nav-arrow {
            margin-left: auto;
            transition: transform .3s ease;
            font-size: 12px;
        }

        .sidebar-menu .menu-open > .nav-link .nav-arrow {
            transform: rotate(90deg);
        }

        /* Main Content */
        .app-main {
            background-color: var(--ksop-bg-soft);
            min-height: calc(100vh - 115px);
        }

        .app-content-header {
            padding: 20px 0 10px;
        }

        .app-content-header h4 {
            color: var(--ksop-navy-dark);
            font-weight: 700;
            margin: 0;
        }

        /* Dashboard & Card Styles */
        .dashboard-welcome {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
            color: #ffffff;
            background: linear-gradient(115deg, #072540 0%, #0d5c7c 60%, #129aa2 100%);
            box-shadow: 0 12px 30px rgba(10, 73, 105, 0.16);
        }

        .dashboard-welcome .card-body {
            padding: 26px 30px;
        }

        .dashboard-welcome h3 {
            font-weight: 700;
        }

        .dashboard-welcome p {
            color: rgba(255, 255, 255, 0.82);
        }

        .dashboard-stat {
            border: 0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 6px 20px rgba(25, 56, 88, 0.07);
            position: relative;
            display: block;
            margin-bottom: 20px;
            overflow: hidden;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .dashboard-stat:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(25, 56, 88, 0.12);
        }

        .dashboard-stat .inner {
            padding: 20px 22px;
        }

        .dashboard-stat h3 {
            color: var(--ksop-navy-dark);
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .dashboard-stat p {
            margin: 0;
            color: #728498;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .dashboard-stat .icon {
            position: absolute;
            top: 16px;
            right: 20px;
            font-size: 42px;
            color: #dbeaf0;
            transition: transform .3s ease;
        }

        .dashboard-stat:hover .icon {
            transform: scale(1.1);
            color: #c7e1eb;
        }

        .dashboard-stat .small-box-footer {
            border-radius: 0 0 16px 16px;
            color: #128291;
            background: #f7fafc;
            display: block;
            padding: 8px 22px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            border-top: 1px solid #edf2f7;
            transition: background .2s ease;
        }

        .dashboard-stat .small-box-footer:hover {
            background: #edf6f8;
            color: #0b5963;
        }

        .dashboard-card {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(25, 56, 88, 0.07);
            background: #ffffff;
            overflow: hidden;
        }

        .dashboard-card .card-header {
            border-bottom: 1px solid #edf1f5;
            background: #ffffff;
            padding: 16px 22px;
        }

        .dashboard-card .card-title {
            color: var(--ksop-navy-dark);
            font-size: 15px;
            font-weight: 700;
        }

        /* Modern Table & Form Polish */
        .table-modern {
            border-color: #e6edf5;
            margin-bottom: 0;
        }
        .table-modern thead th {
            background-color: #f4f7fb;
            color: var(--ksop-navy-dark);
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .03em;
            border-bottom: 2px solid #dce5ef;
            vertical-align: middle;
            white-space: nowrap;
        }
        .table-modern tbody td {
            vertical-align: middle;
            font-size: 13.5px;
            border-color: #edf2f7;
        }
        .table-modern tbody tr:hover {
            background-color: #f8fbfd;
        }
        .btn-ksop {
            background: linear-gradient(100deg, #108c9a 0%, #12608b 100%);
            border: 0;
            color: #ffffff;
            font-weight: 600;
            border-radius: 10px;
            transition: opacity .2s ease, transform .15s ease;
        }
        .btn-ksop:hover {
            color: #ffffff;
            opacity: .92;
            transform: translateY(-1px);
        }
        .dashboard-card .form-label {
            font-weight: 600;
            color: #334e68;
            font-size: 13.5px;
            margin-bottom: 6px;
        }
        .dashboard-card .form-control,
        .dashboard-card .form-select {
            border-radius: 10px;
            border-color: #dce5ef;
            font-size: 14px;
        }
        .dashboard-card .form-control:focus,
        .dashboard-card .form-select:focus {
            border-color: var(--ksop-teal);
            box-shadow: 0 0 0 0.2rem rgba(16, 152, 163, 0.15);
        }

        /* App Footer */
        .app-footer {
            background-color: #ffffff;
            border-top: 1px solid #e8eef5;
            padding: 14px 24px;
            color: #6c7c8c;
            font-size: 13px;
        }

        /* Compatibility Helpers for Bootstrap 4 -> Bootstrap 5 */
        .float-right, .float-sm-right { float: right !important; }
        .float-left, .float-sm-left { float: left !important; }
        .ml-auto { margin-left: auto !important; }
        .mr-auto { margin-right: auto !important; }
        .mr-1 { margin-right: .25rem !important; }
        .mr-2 { margin-right: .5rem !important; }
        .mr-3 { margin-right: 1rem !important; }
        .ml-1 { margin-left: .25rem !important; }
        .ml-2 { margin-left: .5rem !important; }
        .ml-3 { margin-left: 1rem !important; }
        .btn-block { display: block; width: 100%; }
        .form-group { margin-bottom: 1rem; }

        /* Input Group Append & Prepend Compatibility */
        .input-group-append, .input-group-prepend {
            display: flex;
        }
        .input-group-append .input-group-text {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .input-group-prepend .input-group-text {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        /* Badges Compatibility */
        .badge-primary { background-color: #0d6efd !important; color: #ffffff !important; }
        .badge-secondary { background-color: #6c757d !important; color: #ffffff !important; }
        .badge-success { background-color: #198754 !important; color: #ffffff !important; }
        .badge-danger { background-color: #dc3545 !important; color: #ffffff !important; }
        .badge-warning { background-color: #ffc107 !important; color: #000000 !important; }
        .badge-info { background-color: #0dcaf0 !important; color: #000000 !important; }
        .badge-dark { background-color: #212529 !important; color: #ffffff !important; }

        .btn-xs {
            padding: 2px 8px;
            font-size: 12px;
            border-radius: 6px;
        }

        @media (max-width: 767.98px) {
            .dashboard-welcome .card-body {
                padding: 20px;
            }
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <!-- ==================== HEADER (NAVBAR) ==================== -->
        <nav class="app-header navbar navbar-expand bg-body shadow-sm">
            <div class="container-fluid">
                <!-- Left: Sidebar Toggle -->
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link text-body" data-lte-toggle="sidebar" href="#" role="button" aria-label="Toggle Navigation">
                            <i class="bi bi-list fs-4"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-flex align-items-center ms-2">
                        <span class="badge rounded-pill bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 fw-medium">
                            <i class="bi bi-calendar2-week me-1"></i> Catatan Qu &bull; KSOP Kelas II Tanjungpinang
                        </span>
                    </li>
                </ul>

                <!-- Right: Notifications, Fullscreen, User Menu -->
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Notification Bell (Pengingat Agenda) -->
                    <li class="nav-item dropdown me-2">
                        <a class="nav-link position-relative text-body" data-bs-toggle="dropdown" href="#" role="button" title="Pengingat Agenda">
                            <i class="bi bi-bell fs-5"></i>
                            @if (isset($agendaReminders) && count($agendaReminders) > 0)
                                <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">
                                    {{ count($agendaReminders) }}
                                    <span class="visually-hidden">pengingat agenda</span>
                                </span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow-lg border-0 p-0 rounded-3 overflow-hidden">
                            <div class="px-3 py-2 text-white d-flex justify-content-between align-items-center"
                                 style="background: linear-gradient(135deg, #072540 0%, #108c9a 100%);">
                                <span class="fw-bold small mb-0"><i class="bi bi-bell-fill me-1"></i> Pengingat Agenda</span>
                                <span class="badge bg-white text-dark small">{{ count($agendaReminders ?? []) }} Kegiatan</span>
                            </div>
                            <div class="list-group list-group-flush" style="max-height: 320px; overflow-y: auto;">
                                @forelse($agendaReminders ?? [] as $rem)
                                    <a href="{{ route('agenda.show', $rem['id']) }}" class="list-group-item list-group-item-action p-2 border-bottom">
                                        <div class="d-flex align-items-start">
                                            <div class="me-2 mt-1">
                                                @if ($rem['tipe'] === 'H-1')
                                                    <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle-fill"></i> H-1</span>
                                                @else
                                                    <span class="badge bg-danger"><i class="bi bi-play-circle-fill"></i> Hari H</span>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden" style="max-width: 230px;">
                                                <div class="small fw-bold text-truncate text-dark">{{ $rem['uraian'] }}</div>
                                                <div class="text-muted" style="font-size: 11px;"><i class="bi bi-clock me-1"></i>{{ $rem['waktu'] }}</div>
                                                <div class="text-muted text-truncate" style="font-size: 11px;"><i class="bi bi-geo-alt me-1"></i>{{ $rem['tempat'] }}</div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center text-muted py-4 small">
                                        <i class="bi bi-calendar-check text-success fs-3 d-block mb-1"></i>
                                        Tidak ada agenda mendekati saat ini.
                                    </div>
                                @endforelse
                            </div>
                            <a href="{{ route('agenda.index') }}" class="dropdown-item text-center small text-primary fw-semibold py-2 bg-light border-top">
                                Lihat Semua Agenda &raquo;
                            </a>
                        </div>
                    </li>

                    <!-- Fullscreen Toggle -->
                    <li class="nav-item me-2 d-none d-sm-block">
                        <a class="nav-link text-body" data-lte-toggle="fullscreen" href="#" role="button" title="Layar Penuh">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen fs-5"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit fs-5" style="display: none;"></i>
                        </a>
                    </li>

                    <!-- User Profile Dropdown -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center text-body py-1 px-2 rounded-pill hover-bg" data-bs-toggle="dropdown">
                            <img src="{{ $userData && $userData->photo_profil ? asset('storage/photo_profil/' . $userData->photo_profil) : asset('template/dist/img/avatar5.png') }}"
                                class="user-image rounded-circle shadow-sm me-2" alt="Foto Profil"
                                style="width: 32px; height: 32px; object-fit: cover;">
                            <span class="d-none d-md-inline fw-semibold small text-truncate" style="max-width: 140px;">
                                {{ Auth::user()->name }}
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow-lg border-0 rounded-3 p-0 overflow-hidden">
                            <li class="user-header text-white text-center p-3"
                                style="background: linear-gradient(135deg, #07233b 0%, #0b4b75 60%, #1098a5 100%);">
                                <img src="{{ $userData && $userData->photo_profil ? asset('storage/photo_profil/' . $userData->photo_profil) : asset('template/dist/img/avatar5.png') }}"
                                    class="rounded-circle shadow border border-2 border-white mb-2" alt="Foto Profil"
                                    style="width: 72px; height: 72px; object-fit: cover;">
                                <p class="mb-0 fw-bold fs-6">{{ Auth::user()->name }}</p>
                                <small class="text-white-50 d-block">{{ Auth::user()->email }}</small>
                                <small class="text-white-50" style="font-size: 11px;">
                                    Bergabung: {{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : '-' }}
                                </small>
                            </li>
                            <li class="user-footer d-flex justify-content-between p-3 bg-light border-top">
                                <a href="{{ route('profil.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                    <i class="bi bi-person me-1"></i> Profil
                                </a>
                                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm rounded-pill px-3">
                                    <i class="bi bi-box-arrow-right me-1"></i> Log Out
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- ==================== SIDEBAR ==================== -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!-- Brand -->
            <div class="sidebar-brand">
                <a href="{{ route('dashboard') }}" class="brand-link text-decoration-none d-flex align-items-center">
                    <img src="{{ asset('image/logo-kemenhub.png') }}" alt="Logo Kemenhub" class="brand-image rounded shadow-sm">
                    <span class="brand-text fw-semibold ms-2">KSOP Tg.Pinang</span>
                </a>
            </div>

            <!-- Sidebar Wrapper -->
            <div class="sidebar-wrapper">
                <!-- User Panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center px-2">
                    <div class="image">
                        <img src="{{ $userData && $userData->photo_profil ? asset('storage/photo_profil/' . $userData->photo_profil) : asset('template/dist/img/avatar5.png') }}"
                            class="rounded-circle shadow-sm" style="width: 38px; height: 38px; object-fit: cover;" alt="User">
                    </div>
                    <div class="info ms-2 overflow-hidden">
                        <a href="{{ route('profil.index') }}" class="d-block text-white fw-semibold small text-truncate text-decoration-none">
                            {{ Auth::user()->name }}
                        </a>
                        <small class="text-success d-flex align-items-center" style="font-size: 11px;">
                            <span class="badge bg-success rounded-circle p-1 me-1" style="width: 6px; height: 6px;"></span>
                            Petugas Aktif
                        </small>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-speedometer2"></i>
                                <p>DASHBOARD</p>
                            </a>
                        </li>

                        <!-- Agenda -->
                        <li class="nav-item {{ Request::is('agenda*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('agenda*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-calendar3"></i>
                                <p>
                                    AGENDA
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('agenda.index') }}" class="nav-link {{ Request::is('agenda') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-card-checklist"></i>
                                        <p>Daftar Agenda</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('agenda.create') }}" class="nav-link {{ Request::is('agenda/create') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-plus-circle"></i>
                                        <p>Agenda Baru</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Master Data -->
                        <li class="nav-item {{ Request::is('instansi*', 'pegawai*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Request::is('instansi*', 'pegawai*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-database-fill"></i>
                                <p>
                                    MASTER DATA
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('instansi.index') }}" class="nav-link {{ Request::is('instansi*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-building"></i>
                                        <p>Instansi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pegawai.index') }}" class="nav-link {{ Request::is('pegawai*') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-person-badge"></i>
                                        <p>Pegawai</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Management (Admin) -->
                        @can('viewAny', App\Models\User::class)
                            <li class="nav-item {{ Request::is('user*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-person-gear"></i>
                                    <p>
                                        MANAGEMENT
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('user.index') }}" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-shield-lock"></i>
                                            <p>Kelola User</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- ==================== MAIN CONTENT ==================== -->
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    @yield('breadcrumb')
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- ==================== FOOTER ==================== -->
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">
                <small class="text-muted fw-semibold">AdminLTE v4 &bull; Catatan Qu</small>
            </div>
            <small class="text-muted">
                Copyright &copy; {{ date('Y') }} &bull; <strong>KSOP Kelas II Tanjungpinang</strong> &bull; Ditjen Perhubungan Laut &bull; Developer: <strong>bangbhe</strong>
            </small>
        </footer>
    </div>

    <!-- ==================== SCRIPTS ==================== -->
    <!-- jQuery (Needed for DataTables, Select2, DateTimePicker, FullCalendar) -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- OverlayScrollbars JS -->
    <script src="{{ asset('vendor/adminlte-v4/js/overlayscrollbars.browser.es6.min.js') }}"></script>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="{{ asset('vendor/adminlte-v4/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE v4 JS -->
    <script src="{{ asset('vendor/adminlte-v4/js/adminlte.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.11/dist/sweetalert2.all.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- DataTables & Plugins -->
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <!-- Moment & DateTimePicker -->
    <script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- FullCalendar -->
    <script src="{{ asset('template/plugins/fullcalendar/main.js') }}"></script>

    <!-- Sidebar Scrollbar Initialization -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebarWrapper = document.querySelector(".sidebar-wrapper");
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined") {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: "os-theme-light",
                        autoHide: "leave",
                        clickScroll: true,
                    },
                });
            }
        });
    </script>

    <!-- DataTables Config -->
    <script>
        $(function () {
            if ($("#example1").length) {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            }
            if ($("#example2").length) {
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            }
        });
    </script>

    <!-- Select2 Initialization -->
    <script>
        $(function () {
            if ($('.select2').length) {
                $('.select2').select2();
            }
            if ($('.select2bs4').length) {
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                });
            }
        });
    </script>

    <!-- DateTimePicker Initialization -->
    <script>
        $(function () {
            if ($('#tgl_lahir').length) {
                $('#tgl_lahir').datetimepicker({
                    format: 'L'
                });
            }
            if ($('#tgl_mulai').length) {
                $('#tgl_mulai').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
            }
            if ($('#tgl_selesai').length) {
                $('#tgl_selesai').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
            }
            if ($('#pukul').length) {
                $('#pukul').datetimepicker({
                    format: 'HH:mm'
                });
            }
        });
    </script>

    <!-- SweetAlert Tombol Hapus -->
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const form = button.closest('.delete-form');
                Swal.fire({
                    title: 'Hapus Data!',
                    text: "Anda yakin ingin menghapus data ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <!-- SweetAlert Tombol Selesai -->
    <script>
        document.querySelectorAll('.selesai-btn').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const form = button.closest('.selesai-form');
                Swal.fire({
                    title: 'Agenda Selesai!',
                    text: "Anda yakin agenda kegiatan telah selesai?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Selesai!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    <!-- FullCalendar Initialization -->
    <script>
        $(function () {
            var calendarEl = document.getElementById('calendar');
            if (calendarEl && typeof FullCalendar !== "undefined") {
                var Calendar = FullCalendar.Calendar;
                var calendar = new Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    themeSystem: 'bootstrap5',
                    events: [
                        @isset($tanggal_agenda)
                            @foreach ($tanggal_agenda as $data)
                                @if ($data->id)
                                    {
                                        title: 'Agenda {{ $data->jenis_agenda }}',
                                        start: '{{ \Carbon\Carbon::parse($data->tgl_mulai)->format('Y-m-d') }}',
                                        end: '{{ \Carbon\Carbon::parse($data->tgl_selesai)->addDay()->format('Y-m-d') }}',
                                        allDay: true,
                                        backgroundColor: @if ($data->jenis_agenda == 'Hadir Fisik')
                                            '#0073b7'
                                        @elseif ($data->jenis_agenda == 'Zoom Meet (Daring)')
                                            '#f56954'
                                        @else
                                            '#6c757d'
                                        @endif ,
                                        borderColor: @if ($data->jenis_agenda == 'Hadir Fisik')
                                            '#0073b7'
                                        @elseif ($data->jenis_agenda == 'Zoom Meet (Daring)')
                                            '#f56954'
                                        @else
                                            '#6c757d'
                                        @endif ,
                                        url: '{{ route('agenda.show', $data->id) }}'
                                    }@if (!$loop->last),@endif
                                @endif
                            @endforeach
                        @endisset
                    ]
                });
                calendar.render();
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
