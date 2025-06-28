@extends('layouts.app')

@section('title', 'Selamat Datang di Football Atlas')

@section('content')
<style>
    .hero-section {
        background: url('https://images.unsplash.com/photo-1551955132-a7f43e5a5934?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80') no-repeat center center;
        background-size: cover;
        color: white;
        padding: 10rem 0 8rem 0;
        position: relative;
        text-align: center;
        overflow: hidden;
        border-radius: 2rem;
        margin-bottom: 3.5rem;
        box-shadow: 0 8px 32px rgba(99,102,241,0.13);
        animation: fadeInDown 1.2s;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(102, 110, 234, 0.92) 0%, rgba(118, 75, 162, 0.97) 100%);
        z-index: 1;
    }
    .hero-content {
        position: relative;
        z-index: 2;
        animation: fadeInDown 1.2s;
    }
    .feature-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border: 1.5px solid #e0e7ef;
        border-radius: 1.7rem;
        padding: 3rem 1.7rem;
        text-align: center;
        transition: all 0.3s cubic-bezier(.4,2,.6,1);
        animation: fadeInUp 0.7s ease-out backwards;
        box-shadow: 0 8px 32px rgba(99,102,241,0.10);
    }
    .feature-card:hover {
        transform: translateY(-12px) scale(1.03);
        box-shadow: 0 16px 48px rgba(99,102,241,0.18);
    }
    .feature-card .icon {
        font-size: 4.5rem;
        margin-bottom: 1.7rem;
        transition: all 0.3s cubic-bezier(.4,2,.6,1);
    }
    .feature-card:hover .icon {
        transform: scale(1.13);
    }
    .feature-card.negara .icon { color: #4facfe; }
    .feature-card.klub .icon { color: #43e97b; }
    .btn-feature {
        border-radius: 50px;
        padding: 1rem 2.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1.15rem;
        transition: all 0.3s cubic-bezier(.4,2,.6,1);
        background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
        color: #fff;
        box-shadow: 0 2px 8px rgba(99,102,241,0.10);
    }
    .btn-feature:hover {
        background: linear-gradient(90deg, #60a5fa 0%, #6366f1 100%);
        color: #fff;
        box-shadow: 0 6px 24px rgba(99,102,241,0.18);
        transform: scale(1.04);
    }
    .animated-ball {
        position: absolute;
        top: 20%;
        right: 5%;
        z-index: 1;
        font-size: 13rem;
        color: rgba(255, 255, 255, 0.15);
        animation: floatAndRotate 25s ease-in-out infinite;
    }
    @keyframes floatAndRotate {
        0% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-30px) rotate(180deg);
        }
        100% {
            transform: translateY(0) rotate(360deg);
        }
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 992px) {
        .animated-ball {
            display: none;
        }
        .hero-section {
            padding: 7rem 0 5rem 0;
        }
    }
    @keyframes jugglingBall {
        0% { transform: translateY(0); }
        20% { transform: translateY(-40px); }
        40% { transform: translateY(-80px); }
        60% { transform: translateY(-40px); }
        80% { transform: translateY(0); }
        100% { transform: translateY(0); }
    }
    .juggling-figure #juggle-ball {
        animation: jugglingBall 1.4s cubic-bezier(.6,-0.28,.74,.05) infinite;
        transform-origin: 80px 70px;
    }
</style>

<div class="container-fluid px-0">
    <div class="hero-section">
        <div class="animated-ball">
            <i class="bi bi-football"></i>
        </div>
        <!-- Animasi Orang Juggling Bola -->
        <div class="juggling-figure" style="position: absolute; left: 5%; bottom: 0; z-index: 2; height: 260px; width: 160px;">
            <svg width="160" height="260" viewBox="0 0 160 260" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Kepala -->
                <circle cx="80" cy="40" r="28" fill="#f9dcc4" stroke="#e2b07a" stroke-width="3"/>
                <!-- Badan -->
                <rect x="60" y="68" width="40" height="70" rx="20" fill="#6c63ff"/>
                <!-- Lengan kiri -->
                <rect x="30" y="80" width="35" height="14" rx="7" fill="#f9dcc4" transform="rotate(-20 30 80)"/>
                <!-- Lengan kanan -->
                <rect x="95" y="80" width="35" height="14" rx="7" fill="#f9dcc4" transform="rotate(20 125 87)"/>
                <!-- Kaki kiri -->
                <rect x="65" y="138" width="12" height="50" rx="6" fill="#e2b07a"/>
                <!-- Kaki kanan -->
                <rect x="83" y="138" width="12" height="50" rx="6" fill="#e2b07a"/>
                <!-- Sepatu kiri -->
                <ellipse cx="71" cy="192" rx="10" ry="6" fill="#22223b"/>
                <!-- Sepatu kanan -->
                <ellipse cx="89" cy="192" rx="10" ry="6" fill="#22223b"/>
                <!-- Bola (juggling) -->
                <circle id="juggle-ball" cx="80" cy="70" r="12" fill="#fff" stroke="#222" stroke-width="4" filter="url(#shadow)"/>
                <defs>
                    <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
                        <feDropShadow dx="0" dy="2" stdDeviation="2" flood-color="#000" flood-opacity="0.25"/>
                    </filter>
                </defs>
            </svg>
        </div>
        <div class="container">
            <div class="hero-content">
                <h1 class="display-3 fw-bold mb-3">Football Atlas</h1>
                <p class="lead mb-4" style="max-width: 600px; margin-left: auto; margin-right: auto;">
                    Jelajahi dunia sepak bola. Temukan data lengkap negara, klub, dan prestasi mereka di ujung jari Anda.
                </p>
                <div>
                    <a href="{{ route('negara.index') }}" class="btn btn-light btn-lg btn-feature">
                        <i class="bi bi-compass me-2"></i> Jelajahi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row g-4 justify-content-center">
        <div class="col-md-5" style="animation-delay: 0.2s;">
            <div class="feature-card negara">
                <div class="icon"><i class="bi bi-globe-americas"></i></div>
                <h3 class="card-title fw-bold">Negara</h3>
                <p class="card-text text-muted mb-4">
                    Telusuri profil negara, konfederasi, dan daftar lengkap klub yang berkompetisi di dalamnya.
                </p>
                <a href="{{ route('negara.index') }}" class="btn btn-outline-primary btn-feature">Lihat Negara</a>
            </div>
        </div>
        <div class="col-md-5" style="animation-delay: 0.4s;">
            <div class="feature-card klub">
                <div class="icon"><i class="bi bi-shield-shaded"></i></div>
                <h3 class="card-title fw-bold">Klub</h3>
                <p class="card-text text-muted mb-4">
                    Temukan informasi mendalam tentang klub favorit Anda, mulai dari stadion hingga rekor prestasi.
                </p>
                <a href="{{ route('klub.index') }}" class="btn btn-outline-success btn-feature">Lihat Klub</a>
            </div>
        </div>
    </div>
</div>
@endsection 