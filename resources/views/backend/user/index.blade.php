@extends('layouts.admin')

@section('title', 'User')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">User</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">User</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Tabel Data</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                        Tambah</a>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>NIP</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->username }}</td>
                                        <td>{{ $data->nip }}</td>
                                        <td>
                                            @if ($data->role === 'superadmin')
                                                Super Admin
                                            @elseif($data->role === 'admin')
                                                Admin
                                            @elseif($data->role === 'user')
                                                User
                                            @endif
                                        </td>
                                        <td>{{ $data->email }}</td>
                                        <td>
                                            <a href="{{ route('user.edit', $data) }}" class="btn btn-primary btn-sm"><i
                                                    class="fa fa-pen"></i>
                                                Edit</a>
                                            @if (auth()->user()->id !== $data->id)
                                                <form action="{{ route('user.destroy', $data->id) }}" method="POST"
                                                    class="delete-form" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                        <i class="fas fa-trash-alt"></i> Hapus</button>
                                                </form>
                                            @endif
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
