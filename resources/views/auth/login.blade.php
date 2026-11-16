@extends('layouts.auth')

@section('title', 'Login')

@section('full-card')
    <div class="login-modern-card">
        <!-- Brand Panel (Left) -->
        <div class="login-brand-panel">
            <div>
                <div class="brand-badge">
                    <i class="bi bi-shield-check"></i> Portal Resmi KSOP Tg. Pinang
                </div>

                <div class="brand-logo-wrap">
                    <img src="{{ asset('image/logo-kemenhub.png') }}" alt="Logo Kemenhub">
                </div>

                <h1 class="brand-title">
                    Catatan Qu
                    <span>KSOP Tg. Pinang</span>
                </h1>

                <p class="brand-copy">
                    Sistem manajemen pencatatan agenda digital terintegrasi untuk pelayanan pelabuhan yang cepat, akurat, dan transparan.
                </p>

                <ul class="brand-features">
                    <li><i class="bi bi-calendar-check-fill"></i> Jadwal &amp; Notifikasi Agenda H-1 &amp; Hari H</li>
                    <li><i class="bi bi-file-earmark-pdf-fill"></i> Ekspor Laporan Kegiatan Format PDF</li>
                    <li><i class="bi bi-people-fill"></i> Manajemen Pegawai &amp; Instansi Terpadu</li>
                </ul>
            </div>

            <div class="brand-footer">
                <span>&copy; {{ date('Y') }} Ditjen Perhubungan Laut</span>
                <span class="tag-v4">AdminLTE v4</span>
            </div>
        </div>

        <!-- Form Panel (Right) -->
        <div class="login-form-panel">
            <h2 class="form-header-title">Selamat Datang!</h2>
            <p class="form-header-subtitle">Silakan masukkan Email/NIP dan Password untuk masuk ke sistem.</p>

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 small mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (isset($errors) && $errors->any() && !$errors->has('login') && !$errors->has('password'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3 small mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf

                <!-- Input Login (Email atau NIP) -->
                <div class="input-group-modern">
                    <label for="login" class="form-label">Email atau NIP</label>
                    <div class="input-group">
                        <input id="login" type="text" name="login"
                            class="form-control @error('login') is-invalid @enderror"
                            placeholder="Contoh: user@kemenhub.go.id atau NIP"
                            value="{{ old('login') }}" required autofocus autocomplete="username">
                        <span class="input-group-text" id="login-icon">
                            <i class="bi bi-person-badge"></i>
                        </span>
                    </div>
                    @error('login')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Input Password -->
                <div class="input-group-modern">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label mb-0">Password</label>
                    </div>
                    <div class="input-group">
                        <input id="password" type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan password Anda"
                            required autocomplete="current-password">
                        <span class="input-group-text toggle-password" id="togglePasswordBtn" title="Lihat/Sembunyikan Password" role="button">
                            <i class="bi bi-eye" id="togglePasswordIcon"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Ingat saya di perangkat ini
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-ksop-login" id="submitBtn">
                        <span id="btnText"><i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang</span>
                        <span id="btnLoading" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>

                <div class="text-center mt-3 pt-3 border-top">
                    <small class="text-muted d-block">
                        <i class="bi bi-lock-fill text-secondary me-1"></i>
                        Akses aman &bull; Kantor Kesyahbandaran dan Otoritas Pelabuhan Kelas II Tanjungpinang
                    </small>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle Password Visibility
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        if (toggleBtn && passwordInput && toggleIcon) {
            toggleBtn.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                if (type === 'text') {
                    toggleIcon.classList.remove('bi-eye');
                    toggleIcon.classList.add('bi-eye-slash');
                } else {
                    toggleIcon.classList.remove('bi-eye-slash');
                    toggleIcon.classList.add('bi-eye');
                }
            });
        }

        // Form Submit loading state
        const form = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnLoading = document.getElementById('btnLoading');

        if (form && submitBtn) {
            form.addEventListener('submit', function () {
                submitBtn.disabled = true;
                btnText.textContent = 'Memverifikasi...';
                btnLoading.classList.remove('d-none');
            });
        }
    });
</script>
@endpush
