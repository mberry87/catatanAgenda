@extends('layouts.admin')

@section('title', 'Agenda In Progress')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Agenda In Progress</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">In Progress</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h5 class="m-0">Tabel Agenda In Progress</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <div class="table-responsive mt-3">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. Surat</th>
                                    <th>Uraian Kegiatan</th>
                                    <th>Undangan Dari</th>
                                    <th>Jenis Agenda</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jumlahBelumSelesai as $data)
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
                                                <form action="{{ route('agenda.updateStatus', $data->id) }}" method="POST"
                                                    class="selesai-form">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-success btn-sm mr-1 selesai-btn" type="submit"
                                                        title="Tandai Selesai">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('agenda.show', $data) }}"
                                                    class="btn btn-warning btn-sm mr-1" title="Lihat"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('agenda.edit', $data) }}"
                                                    class="btn btn-primary btn-sm mr-1" title="Edit"><i class="fa fa-pen"></i></a>
                                                @can('viewAny', App\Models\User::class)
                                                    <form action="{{ route('agenda.destroy', $data->id) }}" method="POST"
                                                        class="delete-form" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn" title="Hapus">
                                                            <i class="fas fa-trash-alt"></i></button>
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
