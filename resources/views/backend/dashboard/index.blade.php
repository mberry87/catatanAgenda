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
    {{-- ==================== STAT BOXES (AGENDA) ==================== --}}
    <div class="row">
        {{-- In Progress --}}
        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $count_in_progress }}</h3>
                    <p>AGENDA IN PROGRESS</p>
                </div>
                <div class="icon"><i class="fas fa-spinner"></i></div>
                <a href="{{ route('status.countBelumSelesai') }}" class="small-box-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Selesai --}}
        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $count_selesai }}</h3>
                    <p>AGENDA SELESAI</p>
                </div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
                <a href="{{ route('status.countSelesai') }}" class="small-box-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Baris ke-2: User & Pegawai --}}
    <div class="row">
        @can('viewAny', App\Models\User::class)
        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\User::whereNotNull('username')->count() }}</h3>
                    <p>USER TERDAFTAR</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
                <a href="{{ route('user.index') }}" class="small-box-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="small-box" style="background-color:#6f42c1; color:#fff;">
                <div class="inner">
                    <h3>{{ $jumlah_pegawai }}</h3>
                    <p>PEGAWAI TERDAFTAR</p>
                </div>
                <div class="icon"><i class="fas fa-id-card"></i></div>
                <a href="{{ route('pegawai.index') }}" class="small-box-footer">
                    Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @endcan
    </div>

    {{-- ==================== MAIN CONTENT ==================== --}}
    <div class="row">
        {{-- List Agenda Aktif --}}
        <div class="col-md-4">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list-ul mr-1"></i> Agenda Aktif
                    </h5>
                    <div class="card-tools">
                        <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-xs">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if ($tanggal_agenda->isEmpty())
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p>Tidak ada agenda aktif</p>
                        </div>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($tanggal_agenda as $data)
                                @php
                                    $badge = $data->status_badge_info;
                                @endphp
                                <li class="list-group-item px-3 py-2">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        {{-- Badge Jenis --}}
                                        @if ($data->jenis_agenda == 'Hadir Fisik')
                                            <span class="badge badge-primary">Hadir Fisik</span>
                                        @elseif ($data->jenis_agenda == 'Zoom Meet (Daring)')
                                            <span class="badge badge-danger">Zoom Meet</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $data->jenis_agenda }}</span>
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
                <div class="card-footer text-center py-2">
                    <a href="{{ route('agenda.index') }}" class="text-sm">
                        Lihat semua agenda <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Kalender --}}
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-calendar mr-1"></i> Kalender Agenda
                    </h5>
                    <div class="card-tools">
                        <div class="d-flex align-items-center" style="font-size:12px; gap: 8px;">
                            <span><span class="badge" style="background:#0073b7;">&nbsp;</span> Hadir Fisik</span>
                            <span><span class="badge badge-danger">&nbsp;</span> Daring</span>
                            <span><span class="badge badge-secondary">&nbsp;</span> Lainnya</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="calendar" style="min-height: 400px; padding: 10px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
