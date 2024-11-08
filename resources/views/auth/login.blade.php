@extends('layouts.auth')

@section('title', 'Login')

@section('logo')
    <div class="login-logo">
        <img src="{{ asset('image/logo-kemenhub.png') }}" alt="logo" style="width: 65px">
        <a href="#">
            <p><b>Catatan</b> Qu <br>
                <span>KSOP Tg.pinang</span>
            </p>
        </a>
    </div>
@endsection

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Silahkan Login</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input id="username" type="text" name="username"
                    class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                    value="{{ old('username') }}">
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
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" value="{{ old('password') }}">
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
            {{-- lupa password dan register --}}
            <div class="row ">
                <div class="col-8 d-none">
                    <p class="mb-0">
                        <a href="forgot-password.html">Lupa password</a>
                    </p>
                    <p class="mb-0">
                        <a href="{{ route('register') }}" class="text-center">{{ __('Register') }}</a>
                    </p>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
