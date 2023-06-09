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
                    <div class="form-group">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('template') }}/dist/img/user4-128x128.jpg" alt="User profile picture">
                            <h3 class="profile-username text-center">Nina Mcintire</h3>
                            <p class="text-muted text-center">Nip : </p>
                            <p class="text-muted text-center">Golongan : </p>
                            <p class="text-muted text-center">Status : </p>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload foto profil</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm ">Update foto</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Info Profil</h5>
                </div>
                <div class="card-body">
                    <form action="#">
                        @csrf
                        {{-- @method(PUT) --}}

                        {{-- <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP:</label>
                            <input type="text" class="form-control">
                        </div> --}}
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir:</label>
                            <input type="text" class="form-control">
                        </div>
                        {{-- <div class="form-group">
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
                        </div> --}}
                        <div class="form-group">
                            <label for="agama">Agama:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Update Profil</button>
                        <a href="#" class="btn btn-warning btn-sm">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
