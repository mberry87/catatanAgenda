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
        <div class="col-12">
            <div class="card card-outline card-primary dashboard-card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-people me-2 text-primary"></i>Daftar Data User &amp; Hak Akses
                    </h5>
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm px-3">
                        <i class="bi bi-plus-lg me-1"></i> Tambah User
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No.</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>NIP</th>
                                    <th>Role</th>
                                    <th>Hak Akses</th>
                                    <th>Email</th>
                                    <th style="width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $data)
                                    <tr>
                                        <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                                        <td class="fw-semibold text-dark">{{ $data->name }}</td>
                                        <td>{{ $data->username }}</td>
                                        <td>{{ $data->nip ?: '-' }}</td>
                                        <td>
                                            @if ($data->role === 'superadmin')
                                                <span class="badge bg-danger">Super Admin</span>
                                            @elseif($data->role === 'admin')
                                                <span class="badge bg-primary">Admin</span>
                                            @elseif($data->role === 'user')
                                                <span class="badge bg-secondary">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $allPerms = \App\Models\User::AVAILABLE_PERMISSIONS;
                                                $perms = is_array($data->permissions) ? $data->permissions : null;
                                            @endphp
                                            @if ($perms === null)
                                                <span class="badge bg-info text-dark">
                                                    {{ $data->role === 'admin' ? 'Semua Akses (Default)' : 'Akses Standar User' }}
                                                </span>
                                            @elseif (count($perms) === count($allPerms))
                                                <span class="badge bg-success">Semua Akses ({{ count($perms) }})</span>
                                            @elseif (count($perms) === 0)
                                                <span class="badge bg-light text-muted border">Tidak ada akses</span>
                                            @else
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach ($perms as $perm)
                                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                                            {{ $allPerms[$perm] ?? $perm }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $data->email }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="{{ route('user.edit', $data) }}" class="btn btn-outline-primary btn-sm" title="Edit">
                                                    <i class="bi bi-pencil me-1"></i> Edit
                                                </a>
                                                @if (auth()->user()->id !== $data->id)
                                                    <form action="{{ route('user.destroy', $data->id) }}" method="POST"
                                                        class="delete-form d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-outline-danger btn-sm delete-btn" title="Hapus">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
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
