@extends('layouts.admin')

@section('title', 'Detail Agenda')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Detail Agenda</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('agenda.index') }}">Agenda</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card dashboard-card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-info-circle me-2 text-primary"></i>Informasi Agenda Kegiatan
                    </h5>
                    <div class="d-flex gap-2">
                        <a href="{{ url()->previous() ?: route('agenda.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        @if (auth()->user()->hasPermission('agenda.edit'))
                            <a href="{{ route('agenda.edit', $agendaShow->id) }}" class="btn btn-ksop btn-sm px-3">
                                <i class="bi bi-pencil me-1"></i> Edit Agenda
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-modern">
                            <tbody>
                                <tr>
                                    <th class="bg-light" style="width: 220px;">Status</th>
                                    <td>
                                        @php $badge = $agendaShow->status_badge_info; @endphp
                                        <span class="badge {{ $badge['class'] }} px-3 py-2">
                                            <i class="{{ $badge['icon'] }} me-1"></i> {{ $badge['label'] }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Tempat</th>
                                    <td>{{ $agendaShow->tempat }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Tanggal & Pukul</th>
                                    <td>
                                        <i class="bi bi-calendar3 me-1 text-muted"></i>
                                        {{ \Carbon\Carbon::parse($agendaShow->tgl_mulai)->format('d-m-Y') }}
                                        s.d {{ \Carbon\Carbon::parse($agendaShow->tgl_selesai)->format('d-m-Y') }}
                                        <span class="mx-2 text-muted">|</span>
                                        <i class="bi bi-clock me-1 text-muted"></i><strong>{{ $agendaShow->pukul }} WIB</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Pakaian</th>
                                    <td>{{ $agendaShow->pakaian }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Undangan Dari</th>
                                    <td>{{ $agendaShow->instansi->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Jenis Agenda</th>
                                    <td>{{ $agendaShow->jenis_agenda }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Uraian Kegiatan</th>
                                    <td class="fw-semibold text-dark">{{ $agendaShow->uraian }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Menghadiri (Disposisi)</th>
                                    <td>
                                        @forelse ($agendaShow->pegawai as $data)
                                            <span class="badge rounded-pill bg-primary-subtle text-primary border border-primary-subtle me-1 px-3 py-2">{{ $data->nama }}</span>
                                        @empty
                                            <span class="text-muted">Tidak ada pegawai</span>
                                        @endforelse
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Keterangan</th>
                                    <td>{{ $agendaShow->keterangan ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Penginput</th>
                                    <td>{{ $agendaShow->user->name ?? $agendaShow->user->email ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
