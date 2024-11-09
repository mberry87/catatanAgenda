@extends('layouts.admin')

@section('title', 'Edit Agenda')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Edit Agenda</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit Agenda</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Edit Data</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('agenda.update', $agenda->id) }}" method="POST"
                        class="form-horizontal form-label-left">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nmr_surat">No.Surat</label>
                                    <input type="text" name="nmr_surat" id="nmr_surat"
                                        class="form-control @error('nmr_surat') is-invalid @enderror"
                                        value="{{ old('nmr_surat', $agenda->nmr_surat) }}">
                                    @error('nmr_surat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="uraian" class="form-label">Uraian Kegiatan</label>
                                    <textarea class="form-control @error('uraian') is-invalid @enderror" id="uraian" name="uraian" rows="3">{{ old('uraian', $agenda->uraian) }}</textarea>
                                    @error('uraian')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                                            <div class="input-group date" id="tgl_mulai" data-target-input="nearest">
                                                <input type="text"
                                                    class="form-control datetimepicker-input @error('tgl_mulai') is-invalid @enderror"
                                                    name="tgl_mulai" value="{{ old('tgl_mulai', $agenda->tgl_mulai) }}"
                                                    data-target="#tgl_mulai">
                                                <div class="input-group-append" data-target="#tgl_mulai"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                            @error('tgl_mulai')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                                            <div class="input-group date" id="tgl_selesai" data-target-input="nearest">
                                                <input type="text"
                                                    class="form-control datetimepicker-input @error('tgl_selesai') is-invalid @enderror"
                                                    name="tgl_selesai"
                                                    value="{{ old('tgl_selesai', $agenda->tgl_selesai) }}"
                                                    data-target="#tgl_selesai">
                                                <div class="input-group-append" data-target="#tgl_selesai"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                            @error('tgl_selesai')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pukul" class="form-label">Pukul</label>
                                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                <input type="text"
                                                    class="form-control datetimepicker-input @error('pukul') is-invalid @enderror"
                                                    name="pukul" value="{{ old('pukul', $agenda->pukul) }}"
                                                    data-target="#timepicker">
                                                <div class="input-group-append" data-target="#timepicker"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                                </div>
                                            </div>
                                            @error('pukul')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pakaian</label>
                                            <select class="form-control select2 @error('pakaian') is-invalid @enderror"
                                                name="pakaian" style="width: 100%;">
                                                <option value="PDH (Pakaian Dinas Harian)"
                                                    {{ old('pakaian', $agenda->pakaian) == 'PDH (Pakaian Dinas Harian)' ? 'selected' : '' }}>
                                                    PDH (Pakaian Dinas Harian)
                                                </option>
                                                <option value="PDU (Pakaian Dinas Upacara)"
                                                    {{ old('pakaian', $agenda->pakaian) == 'PDU (Pakaian Dinas Upacara)' ? 'selected' : '' }}>
                                                    PDU (Pakaian Dinas Upacara)
                                                </option>
                                                <option value="Batik"
                                                    {{ old('pakaian', $agenda->pakaian) == 'Batik' ? 'selected' : '' }}>
                                                    Batik
                                                </option>
                                            </select>
                                            @error('pakaian')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tempat">Tempat</label>
                                    <input type="text" name="tempat" id="tempat"
                                        class="form-control @error('tempat') is-invalid @enderror"
                                        value="{{ old('tempat', $agenda->tempat) }}">
                                    @error('tempat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pegawai_id" class="form-label">Disposisi (Pegawai)</label>
                                    <select class="select2 @error('pegawai_id') is-invalid @enderror" multiple="multiple"
                                        id="pegawai_id" name="pegawai_id[]" data-placeholder="Pilih Pegawai"
                                        style="width: 100%;">
                                        @foreach ($pegawai as $p)
                                            <option value="{{ $p->id }}"
                                                {{ in_array($p->id, old('pegawai_id', $agenda->pegawai->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                {{ $p->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pegawai_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="instansi_id" class="form-label">Instansi</label>
                                    <select class="form-control select2 @error('instansi_id') is-invalid @enderror"
                                        id="instansi_id" name="instansi_id">
                                        <option value="" disabled>Pilih Instansi</option>
                                        @foreach ($instansi as $i)
                                            <option value="{{ $i->id }}"
                                                {{ old('instansi_id', $agenda->instansi_id) == $i->id ? 'selected' : '' }}>
                                                {{ $i->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('instansi_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jenis Agenda:</label>
                                    <select class="form-control select2 @error('jenis_agenda') is-invalid @enderror"
                                        name="jenis_agenda">
                                        <option value="Hadir Fisik"
                                            {{ old('jenis_agenda', $agenda->jenis_agenda) == 'Hadir Fisik' ? 'selected' : '' }}>
                                            Hadir Fisik
                                        </option>
                                        <option value="Zoom Meet (Daring)"
                                            {{ old('jenis_agenda', $agenda->jenis_agenda) == 'Zoom Meet (Daring)' ? 'selected' : '' }}>
                                            Zoom Meet (Daring)
                                        </option>
                                    </select>
                                    @error('jenis_agenda')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="status" name="status"
                                        value="{{ old('status', $agenda->status) }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                        rows="3">{{ old('keterangan', $agenda->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <a href="{{ route('agenda.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
