@extends('layouts.admin')

@section('title', 'View SPB')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">View SPB</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">View SPB</li>
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
                    <div class="row">
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="no_regis">Nomor Register SPB</label>
                                <input type="text" name="no_regis" id="no_regis" class="form-control"
                                    value="{{ $spb->no_regis }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="no_surat">Nomor Surat</label>
                                <input type="text" name="no_surat" id="no_surat" class="form-control "
                                    value="{{ $spb->no_surat }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tgl_surat">Tanggal Pemohon</label>
                                <input type="text" name="tgl_surat" class="form-control" value="{{ $spb->tgl_surat }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="pemohon">Nama Pemohon</label>
                                <input type="text" name="pemohon" id="pemohon" class="form-control"
                                    value="{{ $spb->pemohon }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kapal_id">Nama Kapal</label>
                                <input type="text" name="kapal_id" id="kapal_id" class="form-control"
                                    value="{{ $spb->kapal_id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="bendera">Bendera</label>
                                <input type="text" name="bendera" id="bendera" class="form-control"
                                    value="{{ $spb->bendera }}" Readonly>
                            </div>
                            <div class="form-group">
                                <label for="tipe_kapal">Tipe Kapal</label>
                                <input type="text" name="tipe_kapal" id="tipe_kapal" class="form-control"
                                    value="{{ $spb->tipe_kapal }}" Readonly>
                            </div>
                            <div class="form-group">
                                <label for="gt">GT</label>
                                <input type="text" name="gt" id="gt" class="form-control"
                                    value="{{ $spb->gt }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="call_sign">Call Sign</label>
                                <input type="text" name="call_sign" id="call_sign" class="form-control  "
                                    value="$spb->call_sign }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="thn_produksi">Tahun Produksi</label>
                                <input type="text" name="thn_produksi" id="thn_produksi" class="form-control"
                                    value="{{ $spb->thn_produksi }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="perusahaan">Perusahaan</label>
                                <input type="text" name="perusahaan" id="perusahaan" class="form-control"
                                    value="{{ $spb->perusahaan }}" Readonly>
                            </div>
                            <div class="form-group">
                                <label for="no_imo">No IMO</label>
                                <input type="text" name="no_imo" id="no_imo" class="form-control"
                                    value="{{ $spb->no_imo }}" readonly>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group">
                                <label for="nakhoda">Nama Nakhoda</label>
                                <input type="text" name="nakhoda" id="nakhoda" class="form-control"
                                    value="{{ $spb->nakhoda }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Pernyataan Nakhoda</label>
                                <div class="row">
                                    <div class="col">
                                        <label>Tanggal</label>
                                        <input type="text" name="tgl_nakhoda" class="form-control"
                                            value="{{ $spb->tgl_nakhoda }}" readonly>
                                    </div>
                                    <div class="col">
                                        <label>Jam</label>
                                        <input type="text" name="jam_nakhoda" class="form-control"
                                            value="{{ $spb->jam_nakhoda }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bertolak">Bertolak Dari</label>
                                <input type="text" name="bertolak" id="bertolak" class="form-control"
                                    value="{{ $spb->bertolak }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Waktu Bertolak</label>
                                <div class="row">
                                    <div class="col">
                                        <label>Tanggal</label>
                                        <input type="text" name="tgl_bertolak" class="form-control"
                                            value="{{ $spb->tgl_bertolak }}" readonly>
                                    </div>
                                    <div class="col">
                                        <label>Jam</label>
                                        <input type="text" name="jam_bertolak" class="form-control"
                                            value="{{ $spb->jam_bertolak }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pelabuhan_id">Pelabuhan Tujuan</label>
                                <input type="text" name="pelabuhan_id" id="pelabuhan_id" class="form-control"
                                    value="{{ $spb->pelabuhan_id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="jml_crew">Jumlah Crew</label>
                                <input type="text" name="jml_crew" id="jml_crew" class="form-control"
                                    value="{{ $spb->jml_crew }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="muatan">Muatan</label>
                                <input type="text" name="muatan" id="muatan" class="form-control"
                                    value="{{ $spb->muatan }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tmp_terbit">Diterbitkan Di</label>
                                <input type="text" name="tmp_terbit" id="tmp_terbit" class="form-control "
                                    value="{{ $spb->tmp_terbit }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Waktu Terbit</label>
                                <div class="row">
                                    <div class="col">
                                        <label>Tanggal</label>
                                        <input type="text" name="tgl_terbit" class="form-control"
                                            value="{{ $spb->tgl_terbit }}" readonly>
                                    </div>
                                    <div class="col">
                                        <label>Jam</label>
                                        <input type="text" name="jam_bertolak" class="form-control"
                                            value="{{ $spb->jam_bertolak }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pegawai_id">Syahbandar</label>
                                <input type="text" name="pegawai_id" id="pegawai_id" class="form-control"
                                    value="{{ $spb->pegawai_id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="no_pup">No PUP</label>
                                <input type="text" name="no_pup" id="no_pup" class="form-control"
                                    value="{{ $spb->no_pup }}" readonly>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('spb.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-undo"></i>
                        Kembali</a>
                    <a href="{{ route('spb.edit', $spb) }}" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i>
                        Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
