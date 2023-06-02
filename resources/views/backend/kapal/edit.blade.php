@extends('layouts.admin')

@section('title', 'Edit Kapal')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Edit Kapal</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit Kapal</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-6">
            <div class="card">
                <div class="card-header">Edit Kapal</div>
                <div class="card-body">
                    <form action="{{ route('kapal.update', $kapal->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Kapal</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama', $kapal->nama) }}">
                                    @error('nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="call_sign">Call Sign</label>
                                    <input type="text" class="form-control @error('call_sign') is-invalid @enderror"
                                        id="call_sign" name="call_sign" value="{{ old('call_sign', $kapal->call_sign) }}">
                                    @error('call_sign')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bendera_id">Bendera</label>
                                    <select class="form-control" name="bendera_id" id="bendera_id">
                                        <option value="">-- Pilih Bendera --</option>
                                        @foreach ($bendera as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $data->id == $kapal->bendera_id ? 'selected' : '' }}>
                                                {{ $data->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tipe_kapal_id">Tipe Kapal</label>
                                    <select class="form-control" name="tipe_kapal_id" id="tipe_kapal_id">
                                        <option value="">-- Pilih Tipe Kapal --</option>
                                        @foreach ($tipe_kapal as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $data->id == $kapal->tipe_kapal_id ? 'selected' : '' }}>
                                                {{ $data->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="gt">GT</label>
                                            <input type="text"
                                                class="form-control @error('gt') is-invalid @enderror"id="gt"
                                                name="gt" value="{{ old('gt', $kapal->gt) }}">
                                            @error('gt')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="dwt">DWT</label>
                                            <input type="text"
                                                class="form-control @error('dwt') is-invalid @enderror"id="dwt"
                                                name="dwt" value="{{ old('dwt', $kapal->dwt) }}">
                                            @error('dwt')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="loa">LOA</label>
                                            <input type="text"
                                                class="form-control @error('loa') is-invalid @enderror"id="loa"
                                                name="loa" value="{{ old('loa', $kapal->loa) }}">
                                            @error('loa')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kapasitas">Kapasitas</label>
                                    <input type="text"
                                        class="form-control @error('kapasitas') is-invalid @enderror"id="kapasitas"
                                        name="kapasitas" value="{{ old('kapasitas', $kapal->kapasitas) }}">
                                    @error('kapasitas')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="perusahaan_id">Perusahaan</label>
                                    <select class="form-control" name="perusahaan_id" id="perusahaan_id">
                                        <option value="">-- Pilih Perusahaan --</option>
                                        @foreach ($perusahaan as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $data->id == $kapal->perusahaan_id ? 'selected' : '' }}>
                                                {{ $data->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="thn_produksi">Tahun Produksi</label>
                                    <input type="text"
                                        class="form-control @error('thn_produksi') is-invalid @enderror"id="thn_produksi"
                                        name="thn_produksi" value="{{ old('thn_produksi', $kapal->thn_produksi) }}">
                                    @error('thn_produksi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_docking">Tanggal Docking</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="tgl_docking" id="tgl_docking"
                                            class="form-control datetimepicker-input" data-target="#reservationdate"
                                            value="{{ $kapal->tgl_docking }}" />
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('tgl_docking')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <a href="{{ route('kapal.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
