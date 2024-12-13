@extends('layouts.admin')

@section('title', 'Agena Agenda')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Agenda Kegiatan</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Agenda Kegiatan</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Agenda Kegiatan</h5>
                </div>
                <div class="card-body">
                    <table class="table mb-2">
                        <tr>
                            <th>Nomor Surat</th>
                            <td>:</td>
                            <td>{{ $agendaShow->nmr_surat }}</td>
                        </tr>
                        <tr>
                            <th>Tempat</th>
                            <td>:</td>
                            <td>{{ $agendaShow->tempat }}
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal | Pukul</th>
                            <td>:</td>
                            <td>{{ $agendaShow->tgl_mulai }} s.d {{ $agendaShow->tgl_selesai }} | {{ $agendaShow->pukul }}
                            </td>
                        </tr>
                        <tr>
                            <th>Undangan Dari</th>
                            <td>:</td>
                            <td>{{ $agendaShow->instansi->nama }}</td>
                        </tr>
                        <tr>
                            <th>Uraian Kegiatan</th>
                            <td>:</td>
                            <td>{{ $agendaShow->uraian }}</td>
                        </tr>
                        <tr>
                            <th>Menghadiri</th>
                            <td>:</td>
                            <td>
                                @foreach ($agendaShow->pegawai as $data)
                                    <span class="badge  text-bg-primary"> {{ $data->nama }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>:</td>
                            <td>{{ $agendaShow->keterangan }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('dashboard') }}" class="btn btn-warning btn-sm">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
