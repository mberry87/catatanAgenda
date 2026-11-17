@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <p class="login-box-msg">Silakan masuk untuk memulai sesi Anda</p>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show small" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (isset($errors) && $errors->any() && !$errors->has('login') && !$errors->has('password'))
        <div class="alert alert-danger alert-dismissible fade show small" role="alert">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" id="loginForm">
        @csrf

        <div class="input-group mb-3">
            <div class="form-floating">
                <input id="login" type="text" name="login"
                    class="form-control @error('login') is-invalid @enderror"
                    placeholder="Email atau NIP" value="{{ old('login') }}" required autofocus autocomplete="username">
                <label for="login">Email atau NIP</label>
            </div>
            <div class="input-group-text">
                <span class="bi bi-envelope"></span>
            </div>
            @error('login')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <div class="form-floating">
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" required autocomplete="current-password">
                <label for="password">Password</label>
            </div>
            <div class="input-group-text" id="togglePasswordBtn" role="button" title="Lihat/Sembunyikan Password">
                <span class="bi bi-eye" id="togglePasswordIcon"></span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-8 d-inline-flex align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Ingat Saya
                    </label>
                </div>
            </div>
            <div class="col-4">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span id="btnText">Masuk</span>
                        <span id="btnLoading" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        if (toggleBtn && passwordInput && toggleIcon) {
            toggleBtn.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                toggleIcon.classList.toggle('bi-eye');
                toggleIcon.classList.toggle('bi-eye-slash');
            });
        }

        const form = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnLoading = document.getElementById('btnLoading');

        if (form && submitBtn) {
            form.addEventListener('submit', function () {
                submitBtn.disabled = true;
                btnText.textContent = '...';
                btnLoading.classList.remove('d-none');
            });
        }
    });
</script>
@endpush
