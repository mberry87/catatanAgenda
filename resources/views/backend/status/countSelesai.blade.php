@extends('layouts.admin')

@section('title', 'Status')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Selesai</h4>
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
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Tabel Selesai</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                        Tambah</a>
                    <a href="{{ route('dashboard') }}" class="btn btn-warning btn-sm">Kembali</a>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No.Surat</th>
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
                                            {{ $data->uraian }} <br>
                                            <span style="font-size: 14px">
                                                * Menghadiri :
                                                @foreach ($data->pegawai as $pegawai)
                                                    <span class="badge text-bg-primary">{{ $pegawai->nama }} </span>
                                                @endforeach
                                                <br>
                                                * Tanggal : {{ \Carbon\Carbon::parse($data->tgl_mulai)->format('d-m-Y') }}
                                                s.d
                                                {{ \Carbon\Carbon::parse($data->tgl_selesai)->format('d-m-Y') }}
                                                <br>
                                                * Pukul : {{ $data->pukul }}
                                                <br>
                                                * Tempat : {{ $data->tempat }}
                                                <br>
                                                * Pakaian : {{ $data->pakaian }}
                                            </span>

                                        </td>
                                        <td>{{ $data->instansi->nama }}</td>
                                        <td>{{ $data->jenis_agenda }}</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td>
                                            <span class="badge text-bg-primary">{{ $data->status }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('agenda.show', $data) }}"
                                                    class="btn btn-warning btn-sm mr-1"><i class="fa fa-eye"></i></a>
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
