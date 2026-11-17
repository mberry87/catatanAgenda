@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <p class="login-box-msg">Registrasi akun baru</p>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="input-group mb-3">
            <div class="form-floating">
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                <label for="name">Nama Lengkap</label>
            </div>
            <div class="input-group-text">
                <span class="bi bi-person"></span>
            </div>
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <div class="form-floating">
                <input id="username" name="username" type="text"
                    class="form-control @error('username') is-invalid @enderror" placeholder="Username / NIP"
                    value="{{ old('username') }}" required>
                <label for="username">Username / NIP</label>
            </div>
            <div class="input-group-text">
                <span class="bi bi-card-text"></span>
            </div>
            @error('username')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <div class="form-floating">
                <input id="email" name="email" type="email"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                    value="{{ old('email') }}" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group-text">
                <span class="bi bi-envelope"></span>
            </div>
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <div class="form-floating">
                <input id="password" name="password" type="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <div class="input-group-text">
                <span class="bi bi-lock-fill"></span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <div class="form-floating">
                <input id="password-confirm" name="password_confirmation" type="password"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    placeholder="Konfirmasi Password" required>
                <label for="password-confirm">Konfirmasi Password</label>
            </div>
            <div class="input-group-text">
                <span class="bi bi-shield-lock"></span>
            </div>
            @error('password_confirmation')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-7 d-inline-flex align-items-center">
                <a href="{{ route('login') }}" class="text-decoration-none small">Sudah punya akun?</a>
            </div>
            <div class="col-5">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
