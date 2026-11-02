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
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default">
                        <i class="fa fa-print"></i> Laporan
                    </button>
                    <div class="table-responsive mt-3">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. Surat</th>
                                    <th>Agenda Kegiatan</th>
                                    <th>Undangan Dari</th>
                                    <th>Jenis Agenda</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
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
                                        <td>{{ $data->nmr_surat }}</td>
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
                                        <td>
                                            <div class="d-flex">
                                                @if ($data->status !== 'Selesai')
                                                    <form action="{{ route('agenda.updateStatus', $data->id) }}"
                                                        method="POST" class="selesai-form">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-success btn-sm mr-1 selesai-btn"
                                                            type="submit" title="Tandai Selesai">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('agenda.show', $data) }}"
                                                    class="btn btn-warning btn-sm mr-1" title="Lihat">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('agenda.edit', $data) }}"
                                                    class="btn btn-primary btn-sm mr-1" title="Edit">
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

    {{-- Modal Laporan --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Laporan Agenda Kegiatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="lh-2">
                        ============================ <br>
                        *AGENDA KEGIATAN* <br>
                        ============================
                        @if ($laporan->isEmpty())
                            <h5>Agenda kegiatan tidak ditemukan</h5>
                        @else
                            @foreach ($laporan as $data)
                                <p>
                                    📑 Agenda : <span>{{ $data->uraian }}</span><br>
                                    📅 Tanggal :
                                    <span>{{ \Carbon\Carbon::parse($data->tgl_mulai)->format('d-m-Y') }} s.d
                                        {{ \Carbon\Carbon::parse($data->tgl_selesai)->format('d-m-Y') }}</span><br>
                                    🕣 Pukul : <span>{{ $data->pukul }} WIB</span><br>
                                    🏢 Tempat : <span>{{ $data->tempat }}</span><br>
                                    ✅ Menghadiri :
                                    @foreach ($data->pegawai as $pegawai)
                                        <span>{{ $pegawai->nama }}, </span>
                                    @endforeach <br>
                                    👕 Pakaian : <span>{{ $data->pakaian }}</span> <br>
                                    ✏️ Keterangan : {{ $data->keterangan ?: '-' }} <br>
                                    ----------------------------
                                </p>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
@endsection
