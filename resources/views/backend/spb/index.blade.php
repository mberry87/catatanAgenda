@extends('layouts.admin')

@section('title', 'SPB')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">SPB</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active">SPB</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-12">
            @if (session('success'))
                <div class="alert alert-success" role="alert" style="width: 50%">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Tabel Data</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('spb.create') }}" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i>
                        Tambah</a>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No.Regis</th>
                                    <th>No.Surat</th>
                                    <th>Tanggal</th>
                                    <th>Pemohon</th>
                                    <th>Nama Kapal</th>
                                    <th>Nama Nakhoda</th>
                                    <th>Bertolak Dari</th>
                                    <th>Tanggal Bertolak</th>
                                    <th>Pelabuhan Tujuan</th>
                                    <th>Petugas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($spb as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->no_regis }}</td>
                                        <td>{{ $data->no_surat }}</td>
                                        <td>{{ $data->tgl_surat }}</td>
                                        <td>{{ $data->pemohon }}</td>
                                        <td>{{ $data->kapal->nama }}</td>
                                        <td>{{ $data->nakhoda }}</td>
                                        <td>{{ $data->bertolak }}</td>
                                        <td>{{ $data->waktu_bertolak }}</td>
                                        <td>{{ $data->pelabuhan->nama }}</td>
                                        <td>{{ $data->pegawai->nama }}</td>
                                        <td>
                                            <a href="{{ route('spb.edit', $data) }}" class="btn btn-primary btn-sm "><i
                                                    class="fa
                                                fa-pen"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
