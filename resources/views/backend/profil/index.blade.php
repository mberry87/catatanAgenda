@extends('layouts.admin')

@section('title', 'Profil')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
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
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card dashboard-card mb-4">
                <div class="card-body text-center pt-4">
                    <img class="rounded-circle shadow-sm border border-3 border-white mb-3"
                        style="width: 104px; height: 104px; object-fit: cover;"
                        src="{{ $userData->photo_profil ? asset('storage/photo_profil/' . $userData->photo_profil) : asset('template/dist/img/avatar5.png') }}"
                        alt="User profile picture">
                    <h5 class="fw-bold text-dark mb-1">{{ $userData->name }}</h5>
                    <p class="text-muted small mb-3">NIP: {{ $userData->nip ?: '-' }}</p>

                    <div class="text-start bg-light rounded-3 p-3 small mb-3 border" style="border-color: #e6edf5 !important;">
                        <div class="mb-1"><i class="bi bi-envelope me-2 text-primary"></i>{{ $userData->email }}</div>
                        <div class="mb-1"><i class="bi bi-geo-alt me-2 text-primary"></i>{{ $userData->tmp_lahir ?: '-' }}, {{ $userData->tgl_lahir ?: '-' }}</div>
                        <div><i class="bi bi-person-vcard me-2 text-primary"></i>Agama: {{ $userData->agama ?: '-' }}</div>
                    </div>

                    <form action="{{ route('profil.updateFotoProfil') }}" method="POST" enctype="multipart/form-data" class="text-start">
                        @csrf
                        <div class="mb-2">
                            <label for="photo_profil" class="form-label">Upload Foto Profil</label>
                            <input name="photo_profil" class="form-control form-control-sm" type="file" id="photo_profil">
                        </div>
                        <button type="submit" class="btn btn-ksop btn-sm w-100">
                            <i class="bi bi-camera me-1"></i> Update Foto
                        </button>
                    </form>
                </div>
            </div>

            <div class="card dashboard-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-shield-lock me-2 text-primary"></i>Ubah Password
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profil.updatePassword') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input class="form-control @error('current_password') is-invalid @enderror" type="password" id="current_password" name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input class="form-control @error('new_password') is-invalid @enderror" type="password" id="new_password" name="new_password">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input class="form-control @error('new_password_confirmation') is-invalid @enderror" type="password" id="new_password_confirmation" name="new_password_confirmation">
                            @error('new_password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-ksop btn-sm w-100">
                            <i class="bi bi-key me-1"></i> Ubah Password
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card dashboard-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-lines-fill me-2 text-primary"></i>Update Info Profil
                    </h5>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('profil.updateProfil') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input name="name" id="name" type="text" class="form-control"
                                value="{{ $userData->name }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input name="nip" id="nip" type="text"
                                    class="form-control @error('nip') is-invalid @enderror"
                                    value="{{ old('nip', $userData->nip) }}">
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $userData->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tmp_lahir" class="form-label">Tempat Lahir</label>
                                <input name="tmp_lahir" id="tmp_lahir" type="text"
                                    class="form-control @error('tmp_lahir') is-invalid @enderror"
                                    value="{{ old('tmp_lahir', $userData->tmp_lahir) }}">
                                @error('tmp_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <div class="input-group date" id="tgl_lahir" data-target-input="nearest">
                                    <input type="text"
                                        class="form-control datetimepicker-input @error('tgl_lahir') is-invalid @enderror"
                                        name="tgl_lahir" value="{{ old('tgl_lahir', $userData->tgl_lahir) }}"
                                        data-target="#tgl_lahir">
                                    <div class="input-group-append" data-target="#tgl_lahir" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @error('tgl_lahir')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input name="telepon" id="telepon" type="text"
                                    class="form-control @error('telepon') is-invalid @enderror"
                                    value="{{ old('telepon', $userData->telepon) }}">
                                @error('telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <input name="agama" id="agama" type="text"
                                    class="form-control @error('agama') is-invalid @enderror"
                                    value="{{ old('agama', $userData->agama) }}">
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ $userData->alamat }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm px-3">Kembali</a>
                            <button type="submit" class="btn btn-ksop btn-sm px-4">
                                <i class="bi bi-check-lg me-1"></i> Update Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
