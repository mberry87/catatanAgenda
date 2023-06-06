@extends('layouts.auth')

@section('title', 'Register')

@section('logo')
    <div class="text-center">
        <img src="{{ asset('image/logo-kemenhub.png') }}" alt="logo" style="width: 65px">
        <div class="register-logo">
            <a href="#"><b>KSOP</b> Tg.Pinang</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="card-body register-card-body">

        <p class="login-box-msg">Form Registrasi User</p>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Full Name" value="{{ old('name') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="username" name="username" type="text"
                    class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                    value="{{ old('username') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-id-card"></span>
                    </div>
                </div>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="email" name="email" type="email"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                    value="{{ old('email') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="password" name="password" type="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="password"
                    value="{{ old('password') }}">
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

            <div class="input-group mb-3">
                <input id="password-confirm" name="password_confirmation" type="password"
                    class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Retype password"
                    value="{{ old('password_confirmation') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-8">
                    <a href="{{ route('login') }}" class="text-center">Sudah punya akun</a>
                </div>

                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
