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
        <div class="col col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h5 class="m-0">Tabel Agenda Selesai</h5>
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
                                @foreach ($jumlahSelesai as $data)
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
                                            <span class="badge badge-success p-2">
                                                <i class="fas fa-check-circle mr-1"></i> Selesai
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
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
