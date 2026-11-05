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
        <div class="col col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h5 class="m-0">Tabel Data Agenda</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah
                    </a>

                    <div class="card card-outline card-info mt-3 mb-3">
                        <div class="card-header">
                            <h5 class="m-0"><i class="fas fa-file-pdf mr-1"></i> Download Laporan PDF</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('agenda.pdf') }}" method="GET" target="_blank"
                                class="row align-items-end">
                                <div class="form-group col-md-3 mb-2">
                                    <label for="pdf_dari">Tanggal Dari</label>
                                    <input type="date" name="dari" id="pdf_dari" class="form-control"
                                        value="{{ now()->startOfMonth()->format('Y-m-d') }}" required>
                                </div>
                                <div class="form-group col-md-3 mb-2">
                                    <label for="pdf_sampai">Tanggal Sampai</label>
                                    <input type="date" name="sampai" id="pdf_sampai" class="form-control"
                                        value="{{ now()->endOfMonth()->format('Y-m-d') }}" required>
                                </div>
                                <div class="form-group col-md-3 mb-2">
                                    <label for="pdf_status">Status Agenda</label>
                                    <select name="status" id="pdf_status" class="form-control">
                                        <option value="">Semua Status</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 mb-2">
                                    <button type="submit" class="btn btn-info btn-block">
                                        <i class="fas fa-download mr-1"></i> Download PDF
                                    </button>
                                </div>
                            </form>
                            <small class="text-muted">Pilih rentang tanggal dan status agenda yang ingin dicetak.</small>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Agenda Kegiatan</th>
                                    <th>Undangan Dari</th>
                                    <th>Jenis Agenda</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Penginput</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agendaKegiatan as $data)
                                    @php
                                        $badge = $data->status_badge_info;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $data->uraian }}</strong> <br>
                                            <span style="font-size: 13px">
                                                * Menghadiri :
                                                @foreach ($data->pegawai as $pegawai)
                                                    <span class="badge badge-primary">{{ $pegawai->nama }}</span>
                                                @endforeach
                                                <br>
                                                * Tanggal : {{ \Carbon\Carbon::parse($data->tgl_mulai)->format('d-m-Y') }}
                                                s.d {{ \Carbon\Carbon::parse($data->tgl_selesai)->format('d-m-Y') }}
                                                <br>
                                                * Pukul : <strong>{{ $data->pukul }} WIB</strong>
                                                <br>
                                                * Tempat : {{ $data->tempat }}
                                                <br>
                                                * Pakaian : {{ $data->pakaian }}
                                            </span>
                                        </td>
                                        <td>{{ $data->instansi->nama ?? '-' }}</td>
                                        <td>{{ $data->jenis_agenda }}</td>
                                        <td>{{ $data->keterangan ?: '-' }}</td>
                                        <td>
                                            <span class="badge {{ $badge['class'] }} p-2">
                                                <i class="{{ $badge['icon'] }} mr-1"></i> {{ $badge['label'] }}
                                            </span>
                                        </td>
                                        <td>{{ $data->user->name ?? ($data->user->email ?? '-') }}</td>
                                        <td>
                                            @if ($data->status !== 'Selesai')
                                                <form action="{{ route('agenda.updateStatus', $data->id) }}" method="POST"
                                                    class="selesai-form">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-success btn-sm mr-1 mb-1 selesai-btn"
                                                        type="submit" title="Tandai Selesai">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('agenda.whatsapp', $data->id) }}"
                                                class="btn btn-success btn-sm mr-1" target="_blank"
                                                title="Kirim via WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                            <a href="{{ route('agenda.show', $data) }}" class="btn btn-warning btn-sm mr-1"
                                                title="Lihat">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('agenda.edit', $data) }}" class="btn btn-primary btn-sm mr-1"
                                                title="Edit">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            @can('viewAny', App\Models\User::class)
                                                <form action="{{ route('agenda.destroy', $data->id) }}" method="POST"
                                                    class="delete-form" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                        title="Hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endcan
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
