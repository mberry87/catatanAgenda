@extends('layouts.admin')

@section('title', 'Agenda')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Agenda</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Agenda</li>
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
                        <i class="bi bi-calendar2-event me-2 text-primary"></i>Daftar Agenda Kegiatan
                    </h5>
                    <a href="{{ route('agenda.create') }}" class="btn btn-ksop btn-sm px-3">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Agenda
                    </a>
                </div>
                <div class="card-body">
                    <div class="p-3 mb-4 rounded-3 border bg-light-subtle" style="background-color: #f8fafd; border-color: #e4ecf4 !important;">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-file-earmark-pdf-fill text-danger me-2 fs-5"></i>
                            <span class="fw-bold text-dark">Download Laporan PDF</span>
                            <small class="text-muted ms-2 d-none d-md-inline">Pilih rentang tanggal dan status agenda yang ingin dicetak.</small>
                        </div>
                        <form action="{{ route('agenda.pdf') }}" method="GET" target="_blank" class="row g-2 align-items-end">
                            <div class="col-md-3">
                                <label for="pdf_dari" class="form-label mb-1">Tanggal Dari</label>
                                <input type="date" name="dari" id="pdf_dari" class="form-control form-control-sm"
                                    value="{{ now()->startOfMonth()->format('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="pdf_sampai" class="form-label mb-1">Tanggal Sampai</label>
                                <input type="date" name="sampai" id="pdf_sampai" class="form-control form-control-sm"
                                    value="{{ now()->endOfMonth()->format('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="pdf_status" class="form-label mb-1">Status Agenda</label>
                                <select name="status" id="pdf_status" class="form-select form-select-sm">
                                    <option value="">Semua Status</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100 fw-semibold">
                                    <i class="bi bi-download me-1"></i> Download PDF
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No.</th>
                                    <th>Agenda Kegiatan</th>
                                    <th>Undangan Dari</th>
                                    <th>Jenis Agenda</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Penginput</th>
                                    <th style="width: 170px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agendaKegiatan as $data)
                                    @php
                                        $badge = $data->status_badge_info;
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-bold text-dark mb-1">{{ $data->uraian }}</div>
                                            <div class="small text-muted lh-base">
                                                <div class="mb-1">
                                                    <i class="bi bi-people me-1 text-primary"></i>
                                                    @foreach ($data->pegawai as $pegawai)
                                                        <span class="badge rounded-pill bg-primary-subtle text-primary border border-primary-subtle">{{ $pegawai->nama }}</span>
                                                    @endforeach
                                                </div>
                                                <div>
                                                    <i class="bi bi-calendar3 me-1"></i>
                                                    {{ \Carbon\Carbon::parse($data->tgl_mulai)->format('d-m-Y') }}
                                                    s.d {{ \Carbon\Carbon::parse($data->tgl_selesai)->format('d-m-Y') }}
                                                    &bull; <i class="bi bi-clock ms-1 me-1"></i><strong>{{ $data->pukul }} WIB</strong>
                                                </div>
                                                <div>
                                                    <i class="bi bi-geo-alt me-1"></i>{{ $data->tempat }}
                                                    &bull; <i class="bi bi-person-badge ms-1 me-1"></i>{{ $data->pakaian }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $data->instansi->nama ?? '-' }}</td>
                                        <td>
                                            @if ($data->jenis_agenda == 'Hadir Fisik')
                                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Hadir Fisik</span>
                                            @elseif ($data->jenis_agenda == 'Zoom Meet (Daring)')
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Zoom Meet (Daring)</span>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">{{ $data->jenis_agenda }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $data->keterangan ?: '-' }}</td>
                                        <td>
                                            <span class="badge {{ $badge['class'] }} px-2 py-1">
                                                <i class="{{ $badge['icon'] }} me-1"></i> {{ $badge['label'] }}
                                            </span>
                                        </td>
                                        <td>{{ $data->user->name ?? ($data->user->email ?? '-') }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                @if ($data->status !== 'Selesai')
                                                    <form action="{{ route('agenda.updateStatus', $data->id) }}" method="POST"
                                                        class="selesai-form">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-success btn-sm selesai-btn"
                                                            type="submit" title="Tandai Selesai">
                                                            <i class="bi bi-check-lg"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('agenda.whatsapp', $data->id) }}"
                                                    class="btn btn-outline-success btn-sm" target="_blank"
                                                    title="Kirim via WhatsApp">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                                <a href="{{ route('agenda.show', $data) }}" class="btn btn-outline-warning btn-sm"
                                                    title="Lihat">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('agenda.edit', $data) }}" class="btn btn-outline-primary btn-sm"
                                                    title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                @can('viewAny', App\Models\User::class)
                                                    <form action="{{ route('agenda.destroy', $data->id) }}" method="POST"
                                                        class="delete-form d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-outline-danger btn-sm delete-btn"
                                                            title="Hapus">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
