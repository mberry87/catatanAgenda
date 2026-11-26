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
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                <li class="breadcrumb-item active">Edit User</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-10 col-md-12">
            <div class="card card-outline card-primary dashboard-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-pencil-square me-2 text-primary"></i>Edit Data User &amp; Hak Akses
                    </h5>
                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update', $users->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $users->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" value="{{ old('username', $users->username) }}">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                        id="nip" name="nip" value="{{ old('nip', $users->nip) }}">
                                    @error('nip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                                        @if ($users->role === 'superadmin')
                                            <option value="superadmin" {{ old('role', $users->role) === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                                        @endif
                                        <option value="admin" {{ old('role', $users->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="user" {{ old('role', $users->role) === 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $users->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border h-100">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                        <span class="fw-semibold small text-dark">
                                            <i class="bi bi-shield-check me-1 text-primary"></i> Hak Akses User
                                        </span>
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" id="checkAllPermissions">
                                            <label class="form-check-label small fw-semibold" for="checkAllPermissions">
                                                Pilih Semua
                                            </label>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted small mb-3">Centang hak akses yang diberikan kepada user ini:</p>
                                        @php
                                            $defaultPerms = in_array($users->role, ['admin', 'superadmin'], true)
                                                ? array_keys($availablePermissions)
                                                : ['agenda.view', 'agenda.create', 'agenda.edit', 'agenda.pdf', 'chat.access', 'chat.sound'];
                                            $currentPerms = old('permissions', is_array($users->permissions) ? $users->permissions : $defaultPerms);
                                        @endphp
                                        <div class="row g-2">
                                            @foreach ($availablePermissions as $key => $label)
                                                <div class="col-12">
                                                    <div class="form-check p-2 border rounded bg-light-subtle ps-5">
                                                        <input class="form-check-input permission-checkbox" type="checkbox"
                                                            name="permissions[]" value="{{ $key }}"
                                                            id="perm_{{ str_replace('.', '_', $key) }}"
                                                            {{ in_array($key, $currentPerms) ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-medium" for="perm_{{ str_replace('.', '_', $key) }}">
                                                            {{ $label }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-sm px-3">Kembali</a>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkAll = document.getElementById('checkAllPermissions');
        const checkboxes = document.querySelectorAll('.permission-checkbox');

        function syncCheckAll() {
            const total = checkboxes.length;
            const checked = Array.from(checkboxes).filter(cb => cb.checked).length;
            checkAll.checked = total > 0 && checked === total;
        }

        if (checkAll) {
            syncCheckAll();
            checkAll.addEventListener('change', function () {
                checkboxes.forEach(cb => cb.checked = checkAll.checked);
            });
            checkboxes.forEach(cb => cb.addEventListener('change', syncCheckAll));
        }
    });
</script>
@endpush
