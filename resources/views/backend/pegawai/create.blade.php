@extends('layouts.admin')

@section('title', 'Tambah Pegawai')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Tambah Pegawai</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">Pegawai</a></li>
                <li class="breadcrumb-item active">Tambah Pegawai</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-10">
            <div class="card card-outline card-primary dashboard-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-plus me-2 text-primary"></i>Tambah Data Pegawai
                    </h5>
                    <a href="{{ route('pegawai.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('pegawai.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama Pegawai</label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}"
                                    placeholder="Masukkan nama pegawai..." required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" id="nip" name="nip"
                                    class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}"
                                    placeholder="Masukkan NIP..." required>
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gol" class="form-label">Golongan</label>
                                <input type="text" id="gol" name="gol"
                                    class="form-control @error('gol') is-invalid @enderror" value="{{ old('gol') }}"
                                    placeholder="Contoh: III/c (opsional)">
                                @error('gol')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="Aktif" {{ old('status', 'Aktif') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Non-Aktif" {{ old('status') === 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                    <option value="Pemberhentian Sementara" {{ old('status') === 'Pemberhentian Sementara' ? 'selected' : '' }}>Pemberhentian Sementara</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" id="jabatan" name="jabatan"
                                    class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}"
                                    placeholder="Masukkan jabatan...">
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="unit_kerja" class="form-label">Unit Kerja</label>
                                <input type="text" id="unit_kerja" name="unit_kerja"
                                    class="form-control @error('unit_kerja') is-invalid @enderror" value="{{ old('unit_kerja') }}"
                                    placeholder="Masukkan unit kerja...">
                                @error('unit_kerja')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-3 pt-3 border-top">
                            <a href="{{ route('pegawai.index') }}" class="btn btn-outline-secondary btn-sm px-3">Kembali</a>
                            <button class="btn btn-outline-warning btn-sm px-3" type="reset">Reset</button>
                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                <i class="bi bi-check-lg me-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
