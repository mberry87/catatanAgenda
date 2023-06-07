@extends('layouts.admin')

@section('title', 'Edit Bendera')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Edit Bendera</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
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
                            <input type="text" class="form-control form-control  @error('nama') is-invalid @enderror"
                                id="nama" name="nama" value="{{ old('nama', $bendera->nama) }}">
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kode">Kode</label>
                            <input type="text" class="form-control form-control  @error('kode') is-invalid @enderror"
                                id="kode" name="kode" value="{{ old('kode', $bendera->kode) }}">
                            @error('kode')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <a href="{{ route('bendera.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
