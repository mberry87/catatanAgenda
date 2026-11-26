@extends('layouts.admin')

@section('title', 'Status Agenda Selesai')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Agenda Selesai</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Selesai</li>
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
                        <i class="bi bi-check-circle-fill me-2 text-success"></i>Tabel Agenda Selesai
                    </h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        @if (auth()->user()->hasPermission('agenda.create'))
                            <a href="{{ route('agenda.create') }}" class="btn btn-ksop btn-sm px-3">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Agenda
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No.</th>
                                    <th>Uraian Kegiatan</th>
                                    <th>Undangan Dari</th>
                                    <th>Jenis Agenda</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th style="width: 130px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jumlahSelesai as $data)
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
                                        <td>{{ $data->jenis_agenda }}</td>
                                        <td>{{ $data->keterangan ?: '-' }}</td>
                                        <td>
                                            <span class="badge bg-success px-2 py-1">
                                                <i class="bi bi-check-circle me-1"></i> Selesai
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="{{ route('agenda.show', $data) }}"
                                                    class="btn btn-outline-warning btn-sm" title="Lihat">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                @if (auth()->user()->hasPermission('agenda.edit'))
                                                    <a href="{{ route('agenda.edit', $data) }}"
                                                        class="btn btn-outline-primary btn-sm" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                @endif
                                                @if (auth()->user()->hasPermission('agenda.delete'))
                                                    <form action="{{ route('agenda.destroy', $data->id) }}" method="POST"
                                                        class="delete-form d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-outline-danger btn-sm delete-btn" title="Hapus">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
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
