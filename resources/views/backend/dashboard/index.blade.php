@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Dashboard</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    {{-- ==================== STAT BOXES (AGENDA, USER, PEGAWAI) ==================== --}}
    <div class="row">
        {{-- In Progress --}}
        <div class="col-lg col-md-6 col-sm-12 mb-4">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ $count_in_progress }}</h3>
                    <p>AGENDA IN PROGRESS</p>
                </div>
                <div class="small-box-icon"><i class="bi bi-hourglass-split"></i></div>
                <a href="{{ route('status.countBelumSelesai') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                    Detail <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>

        {{-- Selesai --}}
        <div class="col-lg col-md-6 col-sm-12 mb-4">
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>{{ $count_selesai }}</h3>
                    <p>AGENDA SELESAI</p>
                </div>
                <div class="small-box-icon"><i class="bi bi-check-circle"></i></div>
                <a href="{{ route('status.countSelesai') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Detail <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>

        @can('viewAny', App\Models\User::class)
            <div class="col-lg col-md-6 col-sm-12 mb-4">
                <div class="small-box text-bg-info">
                    <div class="inner">
                        <h3>{{ \App\Models\User::whereNotNull('username')->count() }}</h3>
                        <p>USER TERDAFTAR</p>
                    </div>
                    <div class="small-box-icon"><i class="bi bi-people"></i></div>
                    <a href="{{ route('user.index') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                        Detail <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg col-md-6 col-sm-12 mb-4">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $jumlah_pegawai }}</h3>
                        <p>PEGAWAI TERDAFTAR</p>
                    </div>
                    <div class="small-box-icon"><i class="bi bi-person-badge"></i></div>
                    <a href="{{ route('pegawai.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Detail <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </div>
            </div>
        @endcan
    </div>

    {{-- ==================== MAIN CONTENT ==================== --}}
    <div class="row">
        {{-- List Agenda Aktif --}}
        <div class="col-lg-4 col-12 mb-4">
            <div class="card card-outline card-primary dashboard-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-list-ul me-1 text-primary"></i> Agenda Aktif
                    </h5>
                    <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-xs">
                        <i class="bi bi-plus-lg"></i> Tambah
                    </a>
                </div>
                <div class="card-body p-0" style="max-height: 520px; overflow-y: auto;">
                    @if ($tanggal_agenda->isEmpty())
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p>Tidak ada agenda aktif</p>
                        </div>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($tanggal_agenda as $data)
                                <?php
                                $badge = $data->status_badge_info;
                                ?>
                                <li class="list-group-item px-3 py-2">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        {{-- Badge Jenis --}}
                                        @if ($data->jenis_agenda == 'Hadir Fisik')
                                            <span class="badge bg-primary">Hadir Fisik</span>
                                        @elseif ($data->jenis_agenda == 'Zoom Meet (Daring)')
                                            <span class="badge bg-danger">Zoom Meet</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $data->jenis_agenda }}</span>
                                        @endif

                                        {{-- Badge Status Dinamis --}}
                                        <span class="badge {{ $badge['class'] }}">
                                            <i class="{{ $badge['icon'] }} mr-1"></i> {{ $badge['label'] }}
                                        </span>
                                    </div>

                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        {{ \Carbon\Carbon::parse($data->tgl_mulai)->format('d M Y') }}
                                        @if ($data->tgl_mulai != $data->tgl_selesai)
                                            — {{ \Carbon\Carbon::parse($data->tgl_selesai)->format('d M Y') }}
                                        @endif
                                    </small>

                                    <div style="font-size: 13px; line-height: 1.4; margin-top: 4px;">
                                        {{ Str::limit($data->uraian, 80) }}
                                    </div>

                                    <div class="mt-1">
                                        <a href="{{ route('agenda.show', $data->id) }}"
                                            class="btn btn-xs btn-outline-secondary">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="card-footer text-center py-2 bg-white border-top" style="border-color:#edf1f5 !important;">
                    <a href="{{ route('agenda.index') }}" class="text-sm">
                        Lihat semua agenda <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Kalender --}}
        <div class="col-lg-8 col-12 mb-4">
            <div class="card card-outline card-primary dashboard-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-calendar3 me-1 text-primary"></i> Kalender Agenda
                    </h5>
                    <div class="d-flex align-items-center flex-wrap" style="font-size:12px; gap: 10px;">
                        <span class="d-inline-flex align-items-center gap-1"><span class="rounded-circle d-inline-block" style="width:10px;height:10px;background:#0073b7;"></span> Hadir Fisik</span>
                        <span class="d-inline-flex align-items-center gap-1"><span class="rounded-circle d-inline-block bg-success" style="width:10px;height:10px;"></span> Daring</span>
                        <span class="d-inline-flex align-items-center gap-1"><span class="rounded-circle d-inline-block bg-secondary" style="width:10px;height:10px;"></span> Lainnya</span>
                        <span class="d-inline-flex align-items-center gap-1"><span class="rounded-circle d-inline-block bg-danger" style="width:10px;height:10px;"></span> Hari Nasional</span>
                    </div>
                </div>
                <div class="card-body p-2">
                    <div id="calendar" style="min-height: 450px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== CHARTS ROW ==================== --}}
    <div class="row">
        <div class="col-lg-7 col-12 mb-4">
            <div class="card card-outline card-primary dashboard-card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-bar-chart-fill me-2 text-primary"></i>Grafik Agenda 6 Bulan Terakhir
                    </h5>
                </div>
                <div class="card-body">
                    <div style="height: 260px;">
                        <canvas id="agendaMonthlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-12 mb-4">
            <div class="card card-outline card-info dashboard-card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-pie-chart-fill me-2 text-info"></i>Distribusi Jenis Agenda
                    </h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div style="height: 260px; width: 100%;">
                        <canvas id="agendaTypeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const monthlyCtx = document.getElementById('agendaMonthlyChart');
            if (monthlyCtx && typeof Chart !== 'undefined') {
                new Chart(monthlyCtx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: @json($chartMonths),
                        datasets: [
                            {
                                label: 'In Progress',
                                backgroundColor: '#ffc107',
                                borderColor: '#e0a800',
                                borderWidth: 1,
                                data: @json($chartInProgress)
                            },
                            {
                                label: 'Selesai',
                                backgroundColor: '#198754',
                                borderColor: '#157347',
                                borderWidth: 1,
                                data: @json($chartSelesai)
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                ticks: { beginAtZero: true, precision: 0 }
                            }]
                        }
                    }
                });
            }

            const typeCtx = document.getElementById('agendaTypeChart');
            if (typeCtx && typeof Chart !== 'undefined') {
                new Chart(typeCtx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: @json(array_keys($jenisCounts)),
                        datasets: [{
                            data: @json(array_values($jenisCounts)),
                            backgroundColor: ['#0d6efd', '#198754', '#6c757d'],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'bottom'
                        }
                    }
                });
            }
        });
    </script>
@endpush
