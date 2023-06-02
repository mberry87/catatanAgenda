@extends('layouts.admin')

@section('title', 'Tambah SPB')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Tambah SPB</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Tambah SPB</li>
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
                    <form action="#" class="form-horizontal form-label-left" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="kapal_id">Nama Kapal</label>
                            <select class="form-control select2bs4" id="kapal_id" name="kapal_id">
                                <option value="">-- Silahkan Pilih --</option>
                                @foreach ($kapal as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bendera">Bendera</label>
                            <input type="text" name="bendera" id="bendera"
                                class="form-control  @error('bendera') is-invalid @enderror" value="{{ old('bendera') }}"
                                Readonly>
                            @error('bendera')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="perusahaan">Perusahaan</label>
                            <input type="text" name="perusahaan" id="perusahaan"
                                class="form-control  @error('perusahaan') is-invalid @enderror"
                                value="{{ old('perusahaan') }}" Readonly>
                            @error('perusahaan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tipe_kapal">Tipe Kapal</label>
                            <input type="text" name="tipe_kapal" id="tipe_kapal"
                                class="form-control  @error('tipe_kapal') is-invalid @enderror"
                                value="{{ old('tipe_kapal') }}" Readonly>
                            @error('tipe_kapal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <a href="{{ route('spb.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <button class="btn btn-info btn-sm" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
