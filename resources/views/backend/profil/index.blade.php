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
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class="form-group">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('storage/photo_profil/' . $userData->photo_profil) }}"
                                alt="User profile picture">
                            <h3 class="profile-username text-center">{{ $userData->name }}</h3>
                            <p class="text-muted text-center">Email : {{ $userData->email }}</p>
                            <p class="text-muted text-center">Tempat Tanggal Lahir : </p>
                            <p class="text-muted text-center">Agama : </p>
                        </div>
                        <form action="{{ route('photoProfil') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="photo_profil" class="form-label ">Upload foto profil</label>
                                <input name="photo_profil" class="form-control" type="file" id="photo_profil">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm ">Update foto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Edit Profil</h5>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tmp_lahir" for="tempat_lahir">Tempat Lahir:</label>
                            <input name="name" id="name" type="text" class="form-control"
                                value="{{ $userData->name }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir:</label>
                            <input name="tgl_lahir" id="tgl_lahir" type="text" class="form-control"
                                value="{{ $userData->tgl_lahir }}">
                        </div>
                        <div class="form-group">
                            <label for="Alamat">Alamat:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <textarea class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama:</label>
                            <input name="agama" id="agama" type="text" class="form-control"
                                value="{{ $userData->agama }}">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input name="email" id="email" type="email" class="form-control"
                                value="{{ $userData->email }}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Update Profil</button>
                        <a href="#" class="btn btn-warning btn-sm">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
