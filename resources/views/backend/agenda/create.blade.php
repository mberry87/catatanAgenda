@extends('layouts.admin')

@section('title', 'Tambah Agenda')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Tambah Agenda</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tambah Agenda</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card dashboard-card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-calendar-plus me-2 text-primary"></i>Tambah Data Agenda
                    </h5>
                    <a href="{{ route('agenda.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('agenda.store') }}" method="POST" class="form-horizontal form-label-left">
                        @csrf
                        <div class="row">
                            {{-- KOLOM KIRI --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="uraian">Agenda Kegiatan</label>
                                    <textarea class="form-control @error('uraian') is-invalid @enderror" id="uraian" name="uraian" rows="3"
                                        placeholder="Uraian agenda kegiatan...">{{ old('uraian') }}</textarea>
                                    @error('uraian')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_mulai">Tanggal Mulai</label>
                                            <div class="input-group date" id="tgl_mulai" data-target-input="nearest">
                                                <input type="text"
                                                    class="form-control datetimepicker-input @error('tgl_mulai') is-invalid @enderror"
                                                    name="tgl_mulai" value="{{ old('tgl_mulai') }}" data-target="#tgl_mulai"
                                                    placeholder="YYYY-MM-DD">
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
                                            <label for="tgl_selesai">Tanggal Selesai</label>
                                            <div class="input-group date" id="tgl_selesai" data-target-input="nearest">
                                                <input type="text"
                                                    class="form-control datetimepicker-input @error('tgl_selesai') is-invalid @enderror"
                                                    name="tgl_selesai" value="{{ old('tgl_selesai') }}"
                                                    data-target="#tgl_selesai" placeholder="YYYY-MM-DD">
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
                                            <label for="pukul">Pukul (Format 24 Jam)</label>
                                            <div class="input-group date" id="pukul" data-target-input="nearest">
                                                <input type="text"
                                                    class="form-control datetimepicker-input @error('pukul') is-invalid @enderror"
                                                    id="pukul" name="pukul" value="{{ old('pukul') }}"
                                                    data-target="#pukul" placeholder="Contoh: 09:00 atau 14:30">
                                                <div class="input-group-append" data-target="#pukul"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                                </div>
                                            </div>
                                            <small class="text-muted">Gunakan format 24 jam (misal 14:30 untuk 2:30
                                                siang)</small>
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
                                                <option value="" disabled
                                                    {{ old('pakaian') === null ? 'selected' : '' }}>
                                                    Pilih Jenis Pakaian</option>
                                                @foreach (['PDH (Pakaian Dinas Harian)', 'PDL (Pakaian Dinas Lapangan)', 'PDU (Pakaian Dinas Upacara)', 'Batik', 'Bebas Rapi'] as $pakaian)
                                                    <option value="{{ $pakaian }}"
                                                        {{ old('pakaian') == $pakaian ? 'selected' : '' }}>
                                                        {{ $pakaian }}</option>
                                                @endforeach
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
                                        value="{{ old('tempat') }}" placeholder="Tempat kegiatan...">
                                    @error('tempat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- KOLOM KANAN --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pegawai_id">Disposisi (Pegawai)</label>
                                    <select class="form-control select2-pegawai @error('pegawai_id') is-invalid @enderror"
                                        multiple="multiple" id="pegawai_id" name="pegawai_id[]"
                                        data-placeholder="Ketik nama pegawai untuk mencari / tambah baru"
                                        style="width: 100%;">
                                        @foreach ($pegawai as $p)
                                            <option value="{{ $p->id }}"
                                                {{ in_array($p->id, old('pegawai_id', [])) ? 'selected' : '' }}>
                                                {{ $p->nama }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted"><i class="fas fa-info-circle"></i> Ketik nama pegawai baru
                                        lalu tekan Enter.</small>
                                    @error('pegawai_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- INSTANSI: select2 dengan tag (bisa tambah pilihan baru) --}}
                                <div class="form-group">
                                    <label for="instansi_id">Instansi</label>
                                    <select class="form-control select2-tags @error('instansi_id') is-invalid @enderror"
                                        id="instansi_id" name="instansi_id" style="width: 100%;">
                                        <option value="" disabled selected>Pilih atau ketik Instansi baru</option>
                                        @foreach ($instansi as $i)
                                            <option value="{{ $i->id }}"
                                                {{ old('instansi_id') == $i->id ? 'selected' : '' }}>
                                                {{ $i->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted"><i class="fas fa-info-circle"></i>
                                        Ketik nama instansi baru jika belum ada, lalu tekan Enter.</small>
                                    @error('instansi_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- JENIS AGENDA: select2 dengan tag (bisa tambah pilihan baru) --}}
                                <div class="form-group">
                                    <label>Jenis Agenda</label>
                                    <select class="form-control select2-tags @error('jenis_agenda') is-invalid @enderror"
                                        name="jenis_agenda" style="width: 100%;">
                                        <option value="" disabled
                                            {{ old('jenis_agenda') === null ? 'selected' : '' }}>
                                            Pilih atau ketik Jenis Agenda baru</option>
                                        @foreach ($jenisAgendaList as $jenis)
                                            <option value="{{ $jenis }}"
                                                {{ old('jenis_agenda') == $jenis ? 'selected' : '' }}>
                                                {{ $jenis }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted"><i class="fas fa-info-circle"></i>
                                        Ketik jenis agenda baru jika belum ada, lalu tekan Enter.</small>
                                    @error('jenis_agenda')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- STATUS: In Progress, Selesai --}}
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control select2 @error('status') is-invalid @enderror"
                                        id="status" name="status" style="width: 100%;">
                                        @foreach ($statusList as $s)
                                            <option value="{{ $s }}"
                                                {{ old('status', 'In Progress') == $s ? 'selected' : '' }}>
                                                {{ $s }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                        rows="3" placeholder="Keterangan tambahan...">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                    <a href="{{ route('agenda.index') }}" class="btn btn-outline-secondary btn-sm px-3">
                                        <i class="bi bi-arrow-left me-1"></i> Kembali
                                    </a>
                                    <button class="btn btn-outline-warning btn-sm px-3" type="reset">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-ksop btn-sm px-4">
                                        <i class="bi bi-check-lg me-1"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function() {
                $('.select2-tags').select2({
                    tags: true,
                    tokenSeparators: [','],
                    createTag: function(params) {
                        var term = $.trim(params.term);
                        if (term === '') return null;
                        return {
                            id: term,
                            text: term,
                            newTag: true
                        };
                    },
                    placeholder: 'Ketik untuk mencari atau tambah baru...',
                    allowClear: true
                });

                // PEGAWAI: multi-select dengan area pencarian
                $('#pegawai_id').select2({
                    placeholder: 'Ketik nama pegawai untuk mencari / tambah baru',
                    tags: true,
                    tokenSeparators: [','],
                    createTag: function(params) {
                        var term = $.trim(params.term);
                        if (term === '') return null;
                        return {
                            id: term,
                            text: term,
                            newTag: true
                        };
                    },
                    allowClear: true,
                    width: '100%'
                });
            });
        </script>
    @endpush
@endsection
