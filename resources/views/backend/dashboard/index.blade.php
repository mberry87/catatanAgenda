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
        <div class="col-md-4">
            <label for="">Petugas SPB</label>
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid"
                            src="{{ $userData->photo_profil ? asset('storage/photo_profil/' . $userData->photo_profil) : asset('template/dist/img/avatar5.png') }}"
                            alt="User profile picture">
                        <h3 class="profile-username text-center">{{ $userData->name }}</h3>
                        <p class="text-muted text-center">NIP : {{ $userData->nip }}</p>
                        <p class="text-muted text-center">Email : {{ $userData->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\Spb::whereMonth('created_at', now())->count() }}</h3>
                    <p>SPB DITERBITKAN</p>
                </div>
                <div class="icon">
                    <i class="ion ion-document-text"></i>
                </div>
                @can('viewAny', App\User::class)
                    <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                @endcan

            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\User::whereNotNull('username')->count() }}</h3>
                    <p>USER TERDAFTAR</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                @can('viewAny', App\User::class)
                    <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                @endcan

            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $jumlah_pegawai }}</h3>
                    <p>PEGAWAI TERDAFTAR</p>
                </div>
                <div class="icon">
                    <i class="ion ion-card"></i>
                </div>
                @can('viewAny', App\User::class)
                    <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                @endcan
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $jumlah_pelabuhan }}</h3>
                    <p>PELABUHAN</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-boat"></i>
                </div>
                @can('viewAny', App\User::class)
                    <a href="#" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                @endcan

            </div>
        </div>
    </div>

@endsection
