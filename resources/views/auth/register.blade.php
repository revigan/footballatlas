@extends('layouts.app')

@section('title', 'Register')

@section('content')
<style>
    .auth-card {
        background: rgba(255, 255, 255, 0.75);
        box-shadow: 0 16px 48px 0 rgba(99, 102, 241, 0.18);
        backdrop-filter: blur(14px);
        border-radius: 1.7rem;
        border: 1.5px solid #e0e7ef;
        animation: fadeInUp 0.8s cubic-bezier(.4,2,.6,1);
    }
    .gradient-header {
        background: linear-gradient(135deg, #6366f1 0%, #60a5fa 100%);
        border-radius: 1.4rem 1.4rem 0 0;
        color: #fff;
        padding: 2.7rem 1rem 1.7rem 1rem;
        margin: -2.2rem -2.2rem 2rem -2.2rem;
        box-shadow: 0 8px 32px rgba(99, 102, 241, 0.18);
        animation: fadeInDown 1s cubic-bezier(.4,2,.6,1);
    }
    .gradient-header i {
        animation: popIcon 1.2s cubic-bezier(.4,2,.6,1) infinite alternate;
    }
    @keyframes popIcon {
        0% { transform: scale(1) rotate(-8deg); }
        100% { transform: scale(1.18) rotate(8deg); }
    }
    .form-control, .input-group-text {
        border-radius: 1.1rem;
        font-size: 1.08rem;
        padding: 0.85rem 1.1rem;
        border: 1.5px solid #e0e7ef;
        transition: box-shadow 0.2s, border 0.2s;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem #6366f1a0;
        border-color: #6366f1;
        outline: none;
    }
    .btn-gradient {
        background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
        color: #fff;
        border: none;
        border-radius: 1.1rem;
        font-size: 1.13rem;
        font-weight: 700;
        padding: 0.85rem 0;
        transition: all 0.3s cubic-bezier(.4,2,.6,1);
        box-shadow: 0 2px 8px rgba(99,102,241,0.10);
    }
    .btn-gradient:hover {
        transform: scale(1.04) translateY(-3px);
        box-shadow: 0 8px 24px rgba(99,102,241,0.18);
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
<div class="container py-5 d-flex align-items-center justify-content-center min-vh-100">
    <div class="col-md-6 col-lg-5">
        <div class="card auth-card border-0 p-4">
            <div class="gradient-header text-center mb-3">
                <i class="bi bi-person-plus-fill display-3 mb-2"></i>
                <h2 class="fw-bold mb-0">Register</h2>
                <p class="text-light mb-0 op-75">Buat akun Football Atlas baru</p>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-gradient btn-lg">
                        <i class="bi bi-person-plus me-1"></i> Register
                    </button>
                </div>
                <div class="text-center">
                    <small class="text-muted">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></small>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 