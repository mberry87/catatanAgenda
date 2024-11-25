@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Dashboard</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ \App\Models\AgendaKegiatan::where('status', 'Belum Selesai')->count() }}</h3>
                    <p>AGENDA KEGIATAN</p>
                </div>
                <div class="icon">
                    <i class="ion ion-plane"></i>
                </div>
                <a href="{{ route('status.countBelumSelesai') }}" class="small-box-footer">Detail <i
                        class="fas fa-arrow-circle-right"></i></a>


            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ \App\Models\AgendaKegiatan::where('status', 'Selesai')->count() }}</h3>
                    <p>AGENDA SELESAI</p>
                </div>
                <div class="icon">
                    <i class="ion ion-checkmark"></i>
                </div>
                <a href="{{ route('status.countSelesai') }}" class="small-box-footer">Detail <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            @can('viewAny', App\User::class)
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ \App\Models\User::whereNotNull('username')->count() }}</h3>
                        <p>USER TERDAFTAR</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('user.index') }}" class="small-box-footer">Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            @endcan
        </div>
        <div class="col-md-3">
            @can('viewAny', App\User::class)
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $jumlah_pegawai }}</h3>
                        <p>PEGAWAI TERDAFTAR</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-document-text"></i>
                    </div>
                    <a href="{{ route('pegawai.index') }}" class="small-box-footer">Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Agenda</h4>
                </div>
                <div class="card-body">
                    @foreach ($tanggal_agenda as $data)
                        &#9745;
                        @if ($data->jenis_agenda == 'Hadir Fisik')
                            <span class="badge bg-primary">{{ $data->tgl_mulai }}</span>
                        @elseif ($data->jenis_agenda == 'Zoom Meet (Daring)')
                            <span class="badge bg-danger">{{ $data->tgl_mulai }}</span>
                        @endif

                        @if ($data->jenis_agenda == 'Hadir Fisik')
                            <span class="badge bg-primary">Hadir Fisik</span>
                        @elseif ($data->jenis_agenda == 'Zoom Meet (Daring)')
                            <span class="badge bg-danger">Zoom Meet (Daring)</span>
                        @endif <br>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-body p-0">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
