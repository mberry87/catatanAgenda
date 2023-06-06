@extends('layouts.admin')

@section('title', 'Kapal')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Kapal</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Kapal</li>
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
                    <a href="{{ route('kapal.create') }}" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i>
                        Tambah</a>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Kapal</th>
                                    <th>Call Sign</th>
                                    <th>Bendera</th>
                                    <th>Tipe Kapal</th>
                                    <th>GT</th>
                                    <th>DWT</th>
                                    <th>LOA</th>
                                    <th>Kapasitas</th>
                                    <th>Perusahaan</th>
                                    <th>Tahun Produksi</th>
                                    <th>Tanggal Docking</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kapal as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->call_sign }}</td>
                                        <td>{{ $data->bendera->nama }}</td>
                                        <td>{{ $data->tipe_kapal->nama }}</td>
                                        <td>{{ $data->gt }}</td>
                                        <td>{{ $data->dwt }}</td>
                                        <td>{{ $data->loa }}</td>
                                        <td>{{ $data->kapasitas }}</td>
                                        <td>{{ $data->perusahaan->nama }}</td>
                                        <td>{{ $data->thn_produksi }}</td>
                                        <td>{{ $data->tgl_docking }}</td>
                                        <td>
                                            <a href="{{ route('kapal.edit', $data) }}" class="btn btn-primary btn-sm"><i
                                                    class="fa fa-pen"></i>
                                                Edit</a>
                                            <a href="{{ route('kapal.destroy', $data) }}" class="btn btn-danger btn-sm"><i
                                                    class="fas fa-trash-alt">
                                                </i> Hapus</a>
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
