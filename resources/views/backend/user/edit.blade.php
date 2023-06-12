@extends('layouts.admin')

@section('title', 'Edit User')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="m-0">Edit User</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit User</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col col-md-6">
            <div class="card">
                <div class="card-header">Edit User</div>
                <div class="card-body">
                    <form action="{{ route('user.update', $users->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control form-control  @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $users->name) }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control  @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ old('username', $users->username) }}">
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control select2bs4 @error('role') is-invalid @enderror" id="role"
                                name="role">
                                <option value="admin" selected>Admin</option>
                                <option value="user">User</option>
                            </select>
                            @error('role')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control form-control  @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $users->email) }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jika status admin ditampikan option 'admin,user' --}}
                        @if (auth()->user()->role === 'admin')
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control select2bs4" id="role" name="role">
                                    <option value="admin" {{ $users->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ $users->role === 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                        @endif

                        <a href="{{ route('user.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
