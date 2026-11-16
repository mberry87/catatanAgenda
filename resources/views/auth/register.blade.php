@extends('layouts.auth')

@section('title', 'Register')

@section('logo')
    <div class="text-center">
        <img src="{{ asset('image/logo-kemenhub.png') }}" alt="logo" style="width: 65px" class="mb-2">
        <div class="register-logo fs-4 fw-bold">
            <span class="text-primary">KSOP</span> Tg.Pinang
        </div>
        <p class="text-muted small">Registrasi Akun Petugas</p>
    </div>
@endsection

@section('content')
    <div class="register-card-body">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                <div class="input-group-text">
                    <span class="bi bi-person-fill"></span>
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input id="username" name="username" type="text"
                    class="form-control @error('username') is-invalid @enderror" placeholder="Username / NIP"
                    value="{{ old('username') }}" required>
                <div class="input-group-text">
                    <span class="bi bi-card-text"></span>
                </div>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input id="email" name="email" type="email"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Email Kemenhub"
                    value="{{ old('email') }}" required>
                <div class="input-group-text">
                    <span class="bi bi-envelope-fill"></span>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input id="password" name="password" type="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                    required>
                <div class="input-group-text">
                    <span class="bi bi-lock-fill"></span>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input id="password-confirm" name="password_confirmation" type="password"
                    class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Ulangi Password"
                    required>
                <div class="input-group-text">
                    <span class="bi bi-shield-lock-fill"></span>
                </div>
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row align-items-center mt-4">
                <div class="col-7">
                    <a href="{{ route('login') }}" class="text-decoration-none small">
                        <i class="bi bi-arrow-left me-1"></i> Sudah punya akun?
                    </a>
                </div>

                <div class="col-5">
                    <button type="submit" class="btn btn-primary w-100 fw-semibold">{{ __('Register') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
