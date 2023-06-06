@extends('layouts.admin')

@section('title', 'Tambah SPB')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Tambah SPB</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tambah SPB</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Tambah Data</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('spb.store') }}" class="form-horizontal form-label-left" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <label for="no_regis">Nomor Register SPB</label>
                                    <input type="text" name="no_regis" id="no_regis"
                                        class="form-control  @error('no_regis') is-invalid @enderror"
                                        value="{{ old('no_regis') ?? $no_regis }}" readonly>
                                    @error('no_regis')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="no_surat">Nomor Surat</label>
                                    <input type="text" name="no_surat" id="no_surat"
                                        class="form-control  @error('no_surat') is-invalid @enderror"
                                        value="{{ old('no_surat') ?? $no_surat }}" readonly>
                                    @error('no_surat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_surat">Tanggal Pemohon</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="tgl_surat" id="tgl_surat"
                                            class="form-control datetimepicker-input" data-target="#reservationdate" />
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('tgl_surat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pemohon">Nama Pemohon</label>
                                    <input type="text" name="pemohon" id="pemohon"
                                        class="form-control  @error('pemohon') is-invalid @enderror"
                                        value="{{ old('pemohon') }}">
                                    @error('pemohon')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
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
                                        class="form-control  @error('bendera') is-invalid @enderror"
                                        value="{{ old('bendera') }}" Readonly>
                                    @error('bendera')
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
                                <div class="form-group">
                                    <label for="gt">GT</label>
                                    <input type="text" name="gt" id="gt"
                                        class="form-control  @error('gt') is-invalid @enderror" value="{{ old('gt') }}"
                                        readonly>
                                    @error('gt')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="call_sign">Call Sign</label>
                                    <input type="text" name="call_sign" id="call_sign"
                                        class="form-control  @error('call_sign') is-invalid @enderror"
                                        value="{{ old('call_sign') }}" readonly>
                                    @error('call_sign')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="thn_produksi">Tahun Produksi</label>
                                    <input type="text" name="thn_produksi" id="thn_produksi"
                                        class="form-control  @error('thn_produksi') is-invalid @enderror"
                                        value="{{ old('thn_produksi') }}" readonly>
                                    @error('thn_produksi')
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
                                    <label for="no_imo">No IMO</label>
                                    <input type="text" name="no_imo" id="no_imo"
                                        class="form-control  @error('no_imo') is-invalid @enderror"
                                        value="{{ old('no_imo') }}">
                                    @error('no_imo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <label for="nakhoda">Nama Nakhoda</label>
                                    <input type="text" name="nakhoda" id="nakhoda"
                                        class="form-control  @error('nakhoda') is-invalid @enderror"
                                        value="{{ old('nakhoda') }}">
                                    @error('nakhoda')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal & Jam Pernyataan Nakhoda</label>
                                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                        <input type="text" name="waktu_nakhoda" id="waktu_nakhoda"
                                            class="form-control  datetimepicker-input @error('waktu_nakhoda') is-invalid @enderror"
                                            value="{{ old('waktu_nakhoda') }}" data-target="#reservationdatetime" />
                                        <div class="input-group-append" data-target="#reservationdatetime"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('waktu_nakhoda')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bertolak">Bertolak Dari</label>
                                    <input type="text" name="bertolak" id="bertolak"
                                        class="form-control  @error('bertolak') is-invalid @enderror"
                                        value="{{ old('bertolak') }}">
                                    @error('bertolak')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal & Jam Bertolak</label>
                                    <div class="input-group date" id="reservationdatetime2" data-target-input="nearest">
                                        <input type="text" name="waktu_bertolak" id="waktu_bertolak"
                                            class="form-control  datetimepicker-input @error('waktu_bertolak') is-invalid @enderror"
                                            value="{{ old('waktu_bertolak') }}" data-target="#reservationdatetime2" />
                                        <div class="input-group-append" data-target="#reservationdatetime2"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('waktu_bertolak')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pelabuhan_id">Pelabuhan Tujuan</label>
                                    <select class="form-control select2bs4" id="pelabuhan_id" name="pelabuhan_id">
                                        <option value="">-- Silahkan Pilih --</option>
                                        @foreach ($pelabuhan as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jml_crew">Jumlah Crew</label>
                                    <input type="text" name="jml_crew" id="jml_crew"
                                        class="form-control  @error('jml_crew') is-invalid @enderror"
                                        value="{{ old('jml_crew') }}">
                                    @error('jml_crew')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="muatan">Muatan</label>
                                    <input type="text" name="muatan" id="muatan"
                                        class="form-control  @error('muatan') is-invalid @enderror"
                                        value="{{ old('muatan') }}">
                                    @error('muatan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tmp_terbit">Diterbitkan Di</label>
                                    <input type="text" name="tmp_terbit" id="tmp_terbit"
                                        class="form-control  @error('tmp_terbit') is-invalid @enderror"
                                        value="{{ old('tmp_terbit') }}">
                                    @error('tmp_terbit')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal & Jam Terbit</label>
                                    <div class="input-group date" id="reservationdatetime3" data-target-input="nearest">
                                        <input type="text" name="waktu_terbit" id="waktu_terbit"
                                            class="form-control  datetimepicker-input @error('waktu_terbit') is-invalid @enderror"
                                            value="{{ old('waktu_terbit') }}" data-target="#reservationdatetime3" />
                                        <div class="input-group-append" data-target="#reservationdatetime3"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('waktu_terbit')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pegawai_id">Syahbandar</label>
                                    <select class="form-control select2bs4" id="pegawai_id" name="pegawai_id">
                                        <option value="">-- Silahkan Pilih --</option>
                                        @foreach ($pegawai as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_pup">No PUP</label>
                                    <input type="text" name="no_pup" id="no_pup"
                                        class="form-control  @error('no_pup') is-invalid @enderror"
                                        value="{{ old('no_pup') }}">
                                    @error('no_pup')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
