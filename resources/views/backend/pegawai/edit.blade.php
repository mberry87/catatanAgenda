@extends('layouts.admin')

@section('title', 'Edit Pegawai')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Edit Pegawai</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit Pegawai</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-6">
            <div class="card">
                <div class="card-header">Edit Pegawai</div>
                <div class="card-body">
                    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama">Nama Pegawai</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ old('nama', $pegawai->nama) }}">
                        </div>

                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip"
                                value="{{ old('nip', $pegawai->nip) }}">
                        </div>

                        <div class="form-group">
                            <label for="gol">Golongan</label>
                            <input type="text" class="form-control" id="gol" name="gol"
                                value="{{ old('gol', $pegawai->gol) }}">
                        </div>
                        <a href="{{ route('pegawai.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
