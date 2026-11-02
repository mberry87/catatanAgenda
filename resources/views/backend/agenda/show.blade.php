@extends('layouts.admin')

@section('title', 'Detail Agenda')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Detail Agenda</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('agenda.index') }}">Agenda</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h5 class="m-0 font-weight-bold">Informasi Agenda Kegiatan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width: 200px;">Status</th>
                            <td style="width: 20px;">:</td>
                            <td>
                                @php $badge = $agendaShow->status_badge_info; @endphp
                                <span class="badge {{ $badge['class'] }} p-2">
                                    <i class="{{ $badge['icon'] }} mr-1"></i> {{ $badge['label'] }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>No. Surat</th>
                            <td>:</td>
                            <td>{{ $agendaShow->nmr_surat }}</td>
                        </tr>
                        <tr>
                            <th>Tempat</th>
                            <td>:</td>
                            <td>{{ $agendaShow->tempat }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal & Pukul</th>
                            <td>:</td>
                            <td>
                                {{ \Carbon\Carbon::parse($agendaShow->tgl_mulai)->format('d-m-Y') }}
                                s.d {{ \Carbon\Carbon::parse($agendaShow->tgl_selesai)->format('d-m-Y') }}
                                | <strong>{{ $agendaShow->pukul }} WIB</strong>
                            </td>
                        </tr>
                        <tr>
                            <th>Pakaian</th>
                            <td>:</td>
                            <td>{{ $agendaShow->pakaian }}</td>
                        </tr>
                        <tr>
                            <th>Undangan Dari</th>
                            <td>:</td>
                            <td>{{ $agendaShow->instansi->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Agenda</th>
                            <td>:</td>
                            <td>{{ $agendaShow->jenis_agenda }}</td>
                        </tr>
                        <tr>
                            <th>Uraian Kegiatan</th>
                            <td>:</td>
                            <td>{{ $agendaShow->uraian }}</td>
                        </tr>
                        <tr>
                            <th>Menghadiri (Disposisi)</th>
                            <td>:</td>
                            <td>
                                @forelse ($agendaShow->pegawai as $data)
                                    <span class="badge badge-primary mr-1 p-2">{{ $data->nama }}</span>
                                @empty
                                    <span class="text-muted">Tidak ada pegawai</span>
                                @endforelse
                            </td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>:</td>
                            <td>{{ $agendaShow->keterangan ?: '-' }}</td>
                        </tr>
                    </table>
                    <div class="mt-3">
                        <a href="{{ url()->previous() ?: route('agenda.index') }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('agenda.edit', $agendaShow->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-pen"></i> Edit Agenda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
