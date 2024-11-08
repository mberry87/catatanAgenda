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
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ \App\Models\AgendaKegiatan::where('status', 'Belum Selesai')->count() }}</h3>
                    <p>AGENDA KEGIATAN</p>
                </div>
                <div class="icon">
                    <i class="ion ion-plane"></i>
                </div>
                @can('viewAny', App\User::class)
                    <a href="{{ route('agenda.index') }}" class="small-box-footer">Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                @endcan

            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ \App\Models\AgendaKegiatan::where('status', 'Selesai')->count() }}</h3>
                    <p>AGENDA SELESAI</p>
                </div>
                <div class="icon">
                    <i class="ion ion-checkmark"></i>
                </div>
                @can('viewAny', App\User::class)
                    <a href="{{ route('agenda.index') }}" class="small-box-footer">Detail <i
                            class="fas fa-arrow-circle-right"></i></a>
                @endcan
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

@endsection
