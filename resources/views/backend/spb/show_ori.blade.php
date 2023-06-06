@extends('layouts.admin')

@section('title', 'Show SPB')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Show SPB</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Show SPB</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Detail</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">No Registrasi</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->no_regis }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">No Surat</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->no_surat }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tanggal Surat</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->tgl_surat }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pemohon</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->pemohon }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nama Kapal</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->kapal->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Bendera</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->bendera }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tipe Kapal</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->tipe_kapal }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">GT</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->gt }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Call Sign</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->call_sign }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Perusahaan</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->perusahaan }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pelabuhan</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->pelabuhan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pegawai</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->pegawai->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">No IMO</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->no_imo }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Tahun Produksi</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->thn_produksi }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nakhoda</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->nakhoda }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Waktu Nakhoda</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->waktu_nakhoda }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Bertolak</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->bertolak }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Waktu Bertolak</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->waktu_bertolak }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Jumlah Crew</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->jml_crew }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Muatan</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->muatan }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tempat Terbit</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->tmp_terbit }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Waktu Terbit</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->waktu_terbit }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">No PUP</th>
                                        <td class="text-center" style="width: 5%">:</td>
                                        <td>{{ $data->no_pup }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
