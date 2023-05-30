@extends('layouts.admin')

@section('title', 'Edit Bendera')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Edit Bendeara</h4>
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
                <div class="card-header">Edit Bendera</div>
                <div class="card-body">
                    <form action="{{ route('bendera.update', $bendera->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama">Nama Bendera</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ old('nama', $bendera->nama) }}">
                        </div>

                        <div class="form-group">
                            <label for="nip">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode"
                                value="{{ old('kode', $bendera->kode) }}">
                        </div>

                        <a href="{{ route('pegawai.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
