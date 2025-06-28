@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    .stat-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border-radius: 1.3rem;
        border: 1.5px solid #e0e7ef;
        transition: all 0.25s cubic-bezier(.4,2,.6,1);
        overflow: hidden;
        position: relative;
        box-shadow: 0 8px 32px rgba(99,102,241,0.10);
        min-height: 170px;
        animation: fadeInUp 0.7s;
    }
    .stat-card:hover {
        transform: translateY(-7px) scale(1.03);
        box-shadow: 0 16px 48px rgba(99,102,241,0.18);
    }
    .stat-card .icon {
        font-size: 3.7rem;
        position: absolute;
        right: -1.2rem;
        bottom: -1.2rem;
        color: rgba(99,102,241,0.13);
        transform: rotate(-20deg);
        transition: all 0.3s ease;
    }
    .stat-card:hover .icon {
        transform: scale(1.12) rotate(-15deg);
        color: rgba(99,102,241,0.18);
    }
    .stat-card .card-body {
        position: relative;
        z-index: 2;
    }
    .main-header {
        background: linear-gradient(135deg, #6366f1 0%, #60a5fa 100%);
        padding: 3rem 2.2rem 2.2rem 2.2rem;
        border-radius: 2rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 8px 32px rgba(99,102,241,0.13);
        text-align: left;
    }
    .main-header h1 {
        font-size: 2.7rem;
        font-weight: 700;
        letter-spacing: 0.01em;
    }
    .list-item-image {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 1rem;
        background: #f1f5f9;
        border: 2px solid #e2e8f0;
    }
    .glass-list {
        background: rgba(255, 255, 255, 0.93);
        border-radius: 1.2rem;
        padding: 1.2rem;
        border: 1.5px solid #e0e7ef;
        box-shadow: 0 4px 24px rgba(99,102,241,0.07);
        animation: fadeInUp 0.8s;
    }
    .btn-gradient {
        background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
        color: #fff;
        border: none;
        border-radius: 1.2rem;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(99,102,241,0.10);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-gradient:hover {
        color: #fff;
        background: linear-gradient(90deg, #60a5fa 0%, #6366f1 100%);
        box-shadow: 0 6px 24px rgba(99,102,241,0.18);
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container py-5">
    <div class="main-header text-white mb-5">
        <h1 class="fw-bold">Dashboard Admin</h1>
        <p class="mb-0 opacity-75">Selamat datang, {{ Auth::user()->name }}! Kelola data Football Atlas dari sini.</p>
    </div>

    <!-- Statistik -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card stat-card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Negara</h5>
                    <h2 class="card-text fw-bold">{{ $stats['total_negara'] }}</h2>
                </div>
                <div class="icon"><i class="bi bi-globe-americas"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card stat-card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Klub</h5>
                    <h2 class="card-text fw-bold">{{ $stats['total_klub'] }}</h2>
                </div>
                <div class="icon"><i class="bi bi-shield-shaded"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card stat-card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Prestasi</h5>
                    <h2 class="card-text fw-bold">{{ $stats['total_prestasi'] }}</h2>
                </div>
                <div class="icon"><i class="bi bi-trophy-fill"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card stat-card bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title">Total User</h5>
                    <h2 class="card-text fw-bold">{{ $stats['total_users'] }}</h2>
                </div>
                <div class="icon"><i class="bi bi-people-fill"></i></div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Klub Terbaru -->
        <div class="col-md-6 mb-4">
            <div class="glass-list">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="bi bi-shield me-2 text-primary"></i>Klub Terbaru</h5>
                    <a href="{{ route('klub.create') }}" class="btn btn-gradient btn-sm"><i class="bi bi-plus-circle"></i> Tambah</a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($latest_clubs as $klub)
                        <a href="{{ route('klub.show', $klub) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            @if($klub->logo_klub)
                                <img src="{{ asset('storage/' . $klub->logo_klub) }}" alt="Logo" class="list-item-image">
                            @else
                                <div class="list-item-image d-flex align-items-center justify-content-center bg-light">
                                    <i class="bi bi-shield-fill text-muted"></i>
                                </div>
                            @endif
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $klub->nama }}</h6>
                                <small class="text-muted">{{ $klub->negara->nama }}</small>
                            </div>
                            <small class="ms-auto text-muted">{{ $klub->created_at->diffForHumans() }}</small>
                        </a>
                    @empty
                        <div class="list-group-item text-center text-muted">Belum ada data klub.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Negara Terbaru -->
        <div class="col-md-6 mb-4">
            <div class="glass-list">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="bi bi-globe me-2 text-success"></i>Negara Terbaru</h5>
                    <a href="{{ route('negara.create') }}" class="btn btn-gradient btn-sm"><i class="bi bi-plus-circle"></i> Tambah</a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($latest_countries as $negara)
                        <a href="{{ route('negara.show', $negara) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            @if($negara->foto_negara)
                                <img src="{{ asset('storage/' . $negara->foto_negara) }}" alt="Bendera" class="list-item-image">
                            @else
                                <div class="list-item-image d-flex align-items-center justify-content-center bg-light">
                                    <i class="bi bi-flag-fill text-muted"></i>
                                </div>
                            @endif
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $negara->nama }}</h6>
                                <small class="text-muted">{{ $negara->konfederasi }}</small>
                            </div>
                            <small class="ms-auto text-muted">{{ $negara->created_at->diffForHumans() }}</small>
                        </a>
                    @empty
                        <div class="list-group-item text-center text-muted">Belum ada data negara.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 