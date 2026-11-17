@extends('layouts.admin')

@section('title', 'Pegawai')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Pegawai</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Pegawai</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary dashboard-card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-badge me-2 text-primary"></i>Daftar Data Pegawai
                    </h5>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-success btn-sm px-3" data-bs-toggle="modal" data-bs-target="#importCsvModal">
                            <i class="bi bi-file-earmark-spreadsheet me-1"></i> Import CSV
                        </button>
                        <a href="{{ route('pegawai.create') }}" class="btn btn-primary btn-sm px-3">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Pegawai
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No.</th>
                                    <th>Nama Pegawai</th>
                                    <th>NIP</th>
                                    <th>Golongan</th>
                                    <th>Jabatan</th>
                                    <th>Unit Kerja</th>
                                    <th>Status</th>
                                    <th style="width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawai as $data)
                                    <tr>
                                        <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                                        <td class="fw-semibold text-dark">{{ $data->nama }}</td>
                                        <td>{{ $data->nip ?: '-' }}</td>
                                        <td>
                                            @if ($data->gol)
                                                <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle px-2 py-1">{{ $data->gol }}</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $data->jabatan ?: '-' }}</td>
                                        <td>{{ $data->unit_kerja ?: '-' }}</td>
                                        <td>
                                            @if ($data->status === 'Aktif')
                                                <span class="badge bg-success">Aktif</span>
                                            @elseif ($data->status)
                                                <span class="badge bg-warning text-dark">{{ $data->status }}</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="{{ route('pegawai.edit', $data) }}" class="btn btn-outline-primary btn-sm" title="Edit">
                                                    <i class="bi bi-pencil me-1"></i> Edit
                                                </a>
                                                @can('viewAny', App\Models\User::class)
                                                    <form action="{{ route('pegawai.destroy', $data->id) }}" method="POST"
                                                        class="delete-form d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-outline-danger btn-sm delete-btn" title="Hapus">
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

    {{-- Modal Import CSV --}}
    <div class="modal fade" id="importCsvModal" tabindex="-1" aria-labelledby="importCsvModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('pegawai.importCsv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="importCsvModalLabel">
                            <i class="bi bi-file-earmark-spreadsheet me-2 text-success"></i>Import Data Pegawai dari CSV
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="file_csv" class="form-label">Pilih File CSV (.csv)</label>
                            <input type="file" name="file_csv" id="file_csv" class="form-control" accept=".csv,.txt" required>
                        </div>
                        <div class="alert alert-info small mb-0">
                            <i class="bi bi-info-circle me-1"></i>
                            Mendukung pemisah titik koma (<code>;</code>) maupun koma (<code>,</code>). Data dengan <strong>NIP</strong> yang sudah ada akan otomatis <strong>diperbarui</strong>, dan NIP baru akan <strong>ditambahkan</strong>.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="bi bi-upload me-1"></i> Upload &amp; Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
