<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') | SeAgenda (Semua Agenda)</title>

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
        body {
            font-family: 'Source Sans 3', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        /* Default AdminLTE v4 Card, Small-Box & Table Polish */
        .small-box {
            position: relative;
            border-radius: .5rem;
            overflow: hidden;
            margin-bottom: 0;
        }
        .small-box .inner {
            position: relative;
            z-index: 1;
            padding: 16px 18px;
        }
        .small-box .inner h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .small-box .inner p {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 0;
            letter-spacing: .02em;
        }
        .small-box .small-box-icon {
            position: absolute;
            top: 12px;
            right: 16px;
            z-index: 0;
            font-size: 52px;
            line-height: 1;
            color: rgba(0, 0, 0, 0.15);
            pointer-events: none;
        }
        .dashboard-welcome {
            border-radius: .5rem;
        }

        .dashboard-card {
            border-radius: .5rem;
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        }

        .table-modern {
            margin-bottom: 0;
        }

        .table-modern thead th {
            vertical-align: middle;
            white-space: nowrap;
        }

        .table-modern tbody td {
            vertical-align: middle;
        }

        .btn-ksop {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #ffffff;
        }

        .btn-ksop:hover,
        .btn-ksop:focus {
            background-color: #0b5ed7;
            border-color: #0a58ca;
            color: #ffffff;
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
            border-radius: 4px;
        }

        /* Responsive Fixes for All Menus (Mobile & Tablet) */
        .app-content {
            overflow-x: hidden;
        }
        .select2-container {
            width: 100% !important;
        }
        .dataTables_wrapper .dt-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin-bottom: 8px;
        }
        .dataTables_wrapper .dataTables_filter input {
            max-width: 100%;
        }
        @media (max-width: 767.98px) {
            .app-content-header {
                padding: 12px 0 6px;
            }
            .breadcrumb {
                float: none !important;
                margin-top: 4px;
                margin-bottom: 0;
            }
            .dataTables_wrapper .dataTables_filter {
                text-align: left !important;
                margin-top: 6px;
            }
            .fc .fc-header-toolbar {
                flex-wrap: wrap;
                gap: 6px;
            }
            .fc .fc-toolbar-title {
                font-size: 1.05rem !important;
            }
            .navbar-nav .dropdown-menu-lg {
                min-width: 260px;
                max-width: calc(100vw - 24px);
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
                            <i class="bi bi-calendar2-week me-1"></i> SeAgenda (Semua Agenda)
                        </span>
                    </li>
                </ul>

                <!-- Right: Messages, Notifications, Fullscreen, User Menu -->
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Chat Messages Dropdown -->
                    @if (auth()->user()->hasPermission('chat.access'))
                        <li class="nav-item dropdown me-2">
                            <a class="nav-link position-relative text-body" data-bs-toggle="dropdown" href="#" role="button" title="Pesan Masuk">
                                <i class="bi bi-chat-dots fs-5"></i>
                                @if (!empty($unreadChatCount) && $unreadChatCount > 0)
                                    <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">
                                        {{ $unreadChatCount }}
                                        <span class="visually-hidden">pesan masuk</span>
                                    </span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow-lg border-0 p-0 rounded-3 overflow-hidden">
                                <div class="px-3 py-2 text-bg-primary d-flex justify-content-between align-items-center">
                                    <span class="fw-bold small mb-0"><i class="bi bi-chat-dots-fill me-1"></i> Pesan Masuk</span>
                                    <span class="badge bg-white text-dark small">{{ $unreadChatCount ?? 0 }} Baru</span>
                                </div>
                                <div class="list-group list-group-flush" style="max-height: 320px; overflow-y: auto;">
                                    @forelse($recentUnreadChats ?? [] as $chatMsg)
                                        <a href="{{ route('chat.index', ['user' => $chatMsg->sender_id]) }}" class="list-group-item list-group-item-action p-2 border-bottom">
                                            <div class="d-flex align-items-start gap-2">
                                                <img src="{{ $chatMsg->sender && $chatMsg->sender->photo_profil ? asset('storage/photo_profil/' . $chatMsg->sender->photo_profil) : asset('template/dist/img/avatar5.png') }}"
                                                    class="rounded-circle border flex-shrink-0" style="width: 34px; height: 34px; object-fit: cover;" alt="Avatar">
                                                <div class="flex-grow-1 overflow-hidden" style="max-width: 220px;">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="small fw-bold text-truncate text-dark">{{ $chatMsg->sender->name ?? 'User' }}</span>
                                                        <small class="text-muted ms-1" style="font-size: 10px;">{{ $chatMsg->created_at->format('H:i') }}</small>
                                                    </div>
                                                    <div class="text-muted text-truncate" style="font-size: 12px;">
                                                        {{ $chatMsg->message ?: ('📎 ' . $chatMsg->attachment_name) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="text-center text-muted py-4 small">
                                            <i class="bi bi-chat-check text-success fs-3 d-block mb-1"></i>
                                            Tidak ada pesan baru saat ini.
                                        </div>
                                    @endforelse
                                </div>
                                <a href="{{ route('chat.index') }}" class="dropdown-item text-center small text-primary fw-semibold py-2 bg-light border-top">
                                    Buka Semua Pesan &raquo;
                                </a>
                            </div>
                        </li>
                    @endif

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
                            <div class="px-3 py-2 text-bg-primary d-flex justify-content-between align-items-center">
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
                            <li class="user-header text-bg-primary text-center p-3">
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
                    <img src="{{ asset('image/logo-perhubungan.png') }}" alt="Logo Perhubungan" class="brand-image rounded shadow-sm">
                    <span class="brand-text fw-semibold ms-2">SeAgenda</span>
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
                        <li class="nav-item">
                            <a href="{{ route('agenda.index') }}" class="nav-link {{ Request::is('agenda*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-calendar3"></i>
                                <p>AGENDA</p>
                            </a>
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

                        <!-- Chat -->
                        @if (auth()->user()->hasPermission('chat.access'))
                            <li class="nav-item">
                                <a href="{{ route('chat.index') }}" class="nav-link {{ Request::is('chat*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-chat-dots"></i>
                                    <p>
                                        CHAT
                                        @if (!empty($unreadChatCount))
                                            <span class="nav-badge badge text-bg-danger">{{ $unreadChatCount }}</span>
                                        @endif
                                    </p>
                                </a>
                            </li>
                        @endif

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
                <small class="text-muted fw-semibold">AdminLTE v4 &bull; SeAgenda</small>
            </div>
            <small class="text-muted">
                Copyright &copy; {{ date('Y') }} &bull; <strong>SeAgenda</strong> (Semua Agenda) &bull; Developer: <strong>bangbhe</strong>
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

    <!-- SweetAlert Tombol Hapus (Event Delegation untuk DataTables Responsive & Pagination) -->
    <script>
        document.addEventListener('click', function (event) {
            const button = event.target.closest('.delete-btn');
            if (!button) return;
            event.preventDefault();
            const form = button.closest('.delete-form');
            if (!form) return;
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
    </script>

    <!-- SweetAlert Tombol Selesai (Event Delegation untuk DataTables Responsive & Pagination) -->
    <script>
        document.addEventListener('click', function (event) {
            const button = event.target.closest('.selesai-btn');
            if (!button) return;
            event.preventDefault();
            const form = button.closest('.selesai-form');
            if (!form) return;
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
                    eventSources: [
                        {
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
                                                    '#198754'
                                                @else
                                                    '#6c757d'
                                                @endif ,
                                                borderColor: @if ($data->jenis_agenda == 'Hadir Fisik')
                                                    '#0073b7'
                                                @elseif ($data->jenis_agenda == 'Zoom Meet (Daring)')
                                                    '#198754'
                                                @else
                                                    '#6c757d'
                                                @endif ,
                                                url: '{{ route('agenda.show', $data->id) }}'
                                            }@if (!$loop->last),@endif
                                        @endif
                                    @endforeach
                                @endisset
                            ]
                        },
                        {
                            url: '{{ route('dashboard.holidays') }}',
                            failure: function () {
                                // Abaikan jika koneksi offline
                            }
                        }
                    ]
                });
                calendar.render();
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
