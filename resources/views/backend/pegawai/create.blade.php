@extends('layouts.admin')

@section('title', 'Tambah Pegawai')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Tambah Pegawai</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tambah Pegawai</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Tambah Data</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pegawai.store') }}" class="form-horizontal form-label-left" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="nama">Nama Pegawai</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control  @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" id="nip" name="nip"
                                class="form-control @error('nama') is-invalid @enderror" value="{{ old('nip') }}">
                            @error('nip')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gol">Golongan</label>
                            <input type="text" id="gol" name="gol"
                                class="form-control @error('nama') is-invalid @enderror" value="{{ old('gol') }}">
                            @error('gol')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <a href="{{ route('pegawai.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <button class="btn btn-info btn-sm" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
