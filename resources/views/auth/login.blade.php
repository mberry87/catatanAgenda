@extends('layouts.auth')

@section('title', 'Login')

@section('body-class', 'login-modern')

@section('logo')
    <div class="login-brand-panel">
        <div>
            <img src="{{ asset('image/logo-kemenhub.png') }}" alt="Logo Kemenhub" class="brand-logo">
            <h1 class="brand-title">Catatan Qu<br>KSOP Tg. Pinang</h1>
            <p class="brand-copy">Sistem pencatatan agenda digital untuk pelayanan pelabuhan yang cepat, rapi, dan
                terpercaya.</p>
        </div>
        <div class="brand-footer">Aplikasi ini dikembangkan oleh &middot; Bangbhe</div>
    </div>
@endsection

@section('content')
    <div class="login-form-panel">
        <p class="login-box-msg">
            Selamat Datang
            <small>Silakan masuk dengan akun Anda untuk melanjutkan.</small>
        </p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input id="login" type="text" name="login"
                    class="form-control @error('login') is-invalid @enderror" placeholder="Email atau NIP"
                    value="{{ old('login') }}" autofocus autocomplete="username">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                    autocomplete="current-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block btn-login">{{ __('Login') }}</button>
                </div>
            </div>
            {{-- lupa password dan register --}}
            <div class="row mt-3 d-none">
                <div class="col-8">
                    <p class="mb-0">
                        <a href="forgot-password.html">Lupa password</a>
                    </p>
                    <p class="mb-0">
                        <a href="{{ route('register') }}" class="text-center">{{ __('Register') }}</a>
                    </p>
                </div>
            </div>
        </form>
    </div>
@endsection
