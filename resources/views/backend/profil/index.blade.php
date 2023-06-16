@extends('layouts.admin')

@section('title', 'Profil')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col col-sm-6">
            <h4 class="m-0">Profil</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Profil</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid"
                                src="{{ $userData->photo_profil ? asset('storage/photo_profil/' . $userData->photo_profil) : asset('template/dist/img/avatar5.png') }}"
                                alt="User profile picture">

                            <h3 class="profile-username text-center">{{ $userData->name }}</h3>
                            <p class="text-muted text-center">NIP : {{ $userData->nip }}</p>
                            <p class="text-muted text-center">Email : {{ $userData->email }}</p>
                            <p class="text-muted text-center">Tempat Tanggal Lahir : {{ $userData->tmp_lahir }},
                                {{ $userData->tgl_lahir }} </p>
                            <p class="text-muted text-center">Agama : {{ $userData->agama }}</p>
                        </div>
                        <form action="{{ route('profil.updateFotoProfil') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="photo_profil" class="form-label ">Upload foto profil</label>
                                <input name="photo_profil" class="form-control" type="file" id="photo_profil">
                            </div>
                            @error('photo_profil')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-primary btn-sm ">Update foto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Update Info Profil</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profil.updateProfil') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama:</label>
                            <input name="name" id="name" type="text" class="form-control"
                                value="{{ $userData->name }}">
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP:</label>
                            <input name="nip" id="nip" type="text" class="form-control"
                                value="{{ $userData->nip }}">
                        </div>
                        <div class="form-group">
                            <label for="tmp_lahir" for="tempat_lahir">Tempat Lahir:</label>
                            <input name="tmp_lahir" id="tmp_lahir" type="text" class="form-control"
                                value="{{ $userData->tmp_lahir }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" name="tgl_lahir" id="tgl_lahir"
                                    class="form-control datetimepicker-input" data-target="#tgl_lahir"
                                    value="{{ $userData->tgl_lahir }}" />
                                <div class="input-group-append" data-target="#tgl_lahir" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control">{{ $userData->alamat }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon:</label>
                            <input name="telepon" id="telepon" type="text" class="form-control"
                                value="{{ $userData->telepon }}">
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama:</label>
                            <input name="agama" id="agama" type="text" class="form-control"
                                value="{{ $userData->agama }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input name="email" id="email" type="email" class="form-control"
                                value="{{ $userData->email }}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Update Profil</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-warning btn-sm">Kembali</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex flex-row-reverse">
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header">
                    <h5 class="m-0">Update Password</h5>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('profil.updatePassword') }}">
                        @csrf

                        <div class="form-group">
                            <label for="current_password">Password saat ini</label>
                            <input class="form-control" type="password" id="current_password" name="current_password">
                            @error('current_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password">Password baru</label>
                            <input class="form-control" type="password" id="new_password" name="new_password">
                            @error('new_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Konfirmasi Password baru</label>
                            <input class="form-control" type="password" id="confirm_password" name="confirm_password">
                            @error('confirm_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary btn-sm">Ubah Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
