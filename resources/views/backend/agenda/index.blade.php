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
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Tabel Data</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                        Tambah</a>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default"><i
                            class="fa fa-print"></i> Laporan</button>
                    <div class="table-responsive ">
                        <table id="example1" class="table table-bordered table-striped fs-6 ">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No.Surat</th>
                                    <th>Uraian Kegiatan</th>
                                    <th>Tanggal</th>
                                    <th>Pukul</th>
                                    <th>Tempat</TH>
                                    <th>Pakaian</th>
                                    <th>Menghadiri / Disposis</th>
                                    <th>Undangan Dari</th>
                                    <th>Jenis Agenda</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agendaKegiatan as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nmr_surat }}</td>
                                        <td>{{ $data->uraian }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($data->tgl_mulai)->format('d/m/Y') }} -
                                            {{ \Carbon\Carbon::parse($data->tgl_selesai)->format('d/m/Y') }}

                                        </td>
                                        <td>{{ $data->pukul }}</td>
                                        <td>{{ $data->tempat }}</td>
                                        <td>{{ $data->pakaian }}</td>
                                        <td>
                                            @foreach ($data->pegawai as $pegawai)
                                                <span>{{ $pegawai->nama }}</span><br>
                                            @endforeach
                                        </td>
                                        <td>{{ $data->instansi->nama }}</td>
                                        <td>{{ $data->jenis_agenda }}</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td>
                                            @if ($data->status == 'Belum Selesai')
                                                <span class="badge text-bg-danger">Belum Selesai</span>
                                            @elseif($data->status == 'Selesai')
                                                <span class="badge text-bg-primary">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                @if ($data->status == 'Belum Selesai')
                                                    <form action="{{ route('agenda.updateStatus', $data->id) }}"
                                                        method="POST" class="selesai-form">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="btn btn-info btn-sm mr-1 selesai-btn"
                                                            type="submit"><i class="fas fa-check"></i></button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('agenda.edit', $data) }}"
                                                    class="btn btn-primary btn-sm mr-1"><i class="fa fa-pen"></i></a>
                                                @can('viewAny', App\User::class)
                                                    <form action="{{ route('agenda.destroy', $data->id) }}" method="POST"
                                                        class="delete-form" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                            <i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                    {{-- <a href="{{ route('agenda.destroy', $data) }}"
                                                        class="btn btn-danger btn-sm" data-confirm-delete="true"><i
                                                            class="fas fa-trash-alt"></i></a> --}}
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
    {{-- modal view --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Laporan Agenda Kegiatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="lh-2">
                        @if ($laporan->isEmpty())
                            <h5>Agenda kegiatan tidak ditemukan</h5>
                        @else
                            @foreach ($laporan as $data)
                                <span></span>===================================
                                <p>
                                    Uraian : <span>{{ $data->uraian }}</span><br>
                                    Tanggal : <span>{{ $data->tgl_mulai }} - {{ $data->tgl_selesai }}</span><br>
                                    Pukul : <span>{{ $data->pukul }}</span><br>
                                    Tempat : <span>{{ $data->tempat }}</span><br>
                                    Menghadiri : @foreach ($data->pegawai as $pegawai)
                                        <span>{{ $pegawai->nama }},</span>
                                    @endforeach <br>
                                    Keterangan : {{ $data->keterangan }}
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
