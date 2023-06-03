@extends('layouts.admin')

@section('title', 'Tambah Kapal')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Tambah Kapal</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Tambah Kapal</li>
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
                    <form action="{{ route('kapal.store') }}" class="form-horizontal form-label-left" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Kapal</label>
                                    <input type="text" name="nama" id="nama"
                                        class="form-control  @error('nama') is-invalid @enderror"
                                        value="{{ old('nama') }}">
                                    @error('nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="call_sign">Call Sign</label>
                                    <input type="text" name="call_sign" id="call_sign"
                                        class="form-control  @error('call_sign') is-invalid @enderror"
                                        value="{{ old('call_sign') }}">
                                    @error('call_sign')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bendera_id">Bendera</label>
                                    <select class="form-control select2bs4" id="bendera_id" name="bendera_id">
                                        <option value="">-- Silahkan Pilih --</option>
                                        @foreach ($bendera as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tipe_kapal_id">Tipe Kapal</label>
                                    <select class="form-control select2bs4" name="tipe_kapal_id" id="tipe_kapal_id">
                                        <option>-- Silahkan Pilih --</option>
                                        @foreach ($tipe_kapal as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipe_kapal_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col col-md-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="gt">GT</label>
                                            <input type="text" id="gt" name="gt"
                                                class="form-control @error('gt') is-invalid @enderror"
                                                value="{{ old('gt') }}">
                                            @error('gt')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="dwt">DWT</label>
                                            <input type="text" id="dwt" name="dwt"
                                                class="form-control @error('dwt') is-invalid @enderror"
                                                value="{{ old('dwt') }}">
                                            @error('dwt')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="loa">LOA</label>
                                            <input type="text" id="loa" name="loa"
                                                class="form-control @error('loa') is-invalid @enderror"
                                                value="{{ old('loa') }}">
                                            @error('loa')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kapasitas">Kapasitas</label>
                                    <input type="text" id="kapasitas" name="kapasitas"
                                        class="form-control @error('kapasitas') is-invalid @enderror"
                                        value="{{ old('kapasitas') }}">
                                    @error('kapasitas')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="perusahaan_id">Perusahaan</label>
                                    <select class="form-control select2bs4" name="perusahaan_id" id="perusahaan_id">
                                        <option>-- Silahkan Pilih --</option>
                                        @foreach ($perusahaan as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach

                                    </select>
                                    @error('perusahaan_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="thn_produksi">Tahun Produksi</label>
                                    <input type="text" id="thn_produksi" name="thn_produksi"
                                        class="form-control @error('thn_produksi') is-invalid @enderror"
                                        value="{{ old('thn_produksi') }}">
                                    @error('thn_produksi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_docking">Tanggal Docking</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="tgl_docking" id="tgl_docking"
                                            class="form-control datetimepicker-input @error('tgl_docking') is-invalid @enderror"
                                            data-target="#reservationdate" value="{{ old('tgl_docking') }}" />
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('tgl_docking')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('kapal.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <button class="btn btn-info btn-sm" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
