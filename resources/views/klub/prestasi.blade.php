@extends('layouts.app')

@section('title', 'Daftar Prestasi ' . $klub->nama)

@section('content')
<style>
    .glass-card {
        background: rgba(255,255,255,0.85);
        border-radius: 1.5rem;
        border: 1.5px solid #e0e7ef;
        box-shadow: 0 8px 32px rgba(99,102,241,0.10);
        backdrop-filter: blur(12px);
    }
    .achievement-badge {
        background: rgba(255,255,255,0.35);
        border-radius: 0.8rem;
        padding: 1.1rem 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(99,102,241,0.04);
        transition: transform 0.15s, box-shadow 0.15s;
        border: 1px solid #e0e7ef;
    }
    .achievement-badge:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 6px 24px rgba(99,102,241,0.13);
    }
    .btn-gradient {
        background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
        color: #fff;
        border: none;
        border-radius: 2rem;
        padding: 0.7rem 2.2rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(99,102,241,0.10);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-gradient:hover {
        background: linear-gradient(90deg, #60a5fa 0%, #6366f1 100%);
        color: #fff;
        box-shadow: 0 6px 24px rgba(99,102,241,0.18);
    }
    .badge-kategori {
        font-size: 1rem;
        padding: 0.5em 1.2em;
        border-radius: 1.2em;
        font-weight: 500;
        letter-spacing: 0.03em;
        box-shadow: 0 1px 4px rgba(99,102,241,0.08);
    }
</style>
<div class="container py-5">
    <div class="glass-card p-5 mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <div>
                <h3 class="mb-1 fw-bold text-primary">Daftar Prestasi {{ $klub->nama }}</h3>
                @if($kategori)
                    <span class="badge badge-kategori bg-primary bg-gradient text-white">Kategori: {{ $kategori }}</span>
                @endif
            </div>
            <a href="{{ route('klub.show', $klub->id) }}" class="btn btn-gradient"><i class="bi bi-arrow-left"></i> Kembali ke Detail Klub</a>
        </div>
        @if($prestasi->count() > 0)
            <div class="row g-3 justify-content-center">
                @foreach($prestasi as $p)
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="achievement-badge d-flex flex-column align-items-center text-center h-100">
                        <span class="mb-1" style="font-size:2rem;">
                            @if($p->kategori == 'Liga')
                                <i class="bi bi-award text-warning"></i>
                            @elseif($p->kategori == 'Cup')
                                <i class="bi bi-cup text-info"></i>
                            @elseif($p->kategori == 'League Cup')
                                <i class="bi bi-trophy text-success"></i>
                            @elseif($p->kategori == 'Super Cup')
                                <i class="bi bi-star text-primary"></i>
                            @elseif($p->kategori == 'Piala Internasional')
                                <i class="bi bi-globe text-danger"></i>
                            @else
                                <i class="bi bi-trophy text-secondary"></i>
                            @endif
                        </span>
                        <strong class="fs-6 mb-1">{{ $p->nama_prestasi }}</strong>
                        <span class="badge
                            @if($p->kategori == 'Liga') bg-warning text-dark
                            @elseif($p->kategori == 'Cup') bg-info text-white
                            @elseif($p->kategori == 'League Cup') bg-success text-white
                            @elseif($p->kategori == 'Super Cup') bg-primary text-white
                            @elseif($p->kategori == 'Piala Internasional') bg-danger text-white
                            @else bg-secondary text-white @endif
                            mb-2
                        ">{{ $p->kategori }}</span>
                        <span class="badge bg-light text-dark mb-2">{{ $p->tahun }}</span>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <form action="{{ route('prestasi.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-trophy" style="font-size: 3rem; opacity: 0.5;"></i>
                <p class="mb-0 mt-2">Belum ada data prestasi</p>
            </div>
        @endif
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('klub.show', $klub->id) }}" class="btn btn-gradient btn-lg rounded-pill px-5"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>
@endsection
@if(session('success'))
<script>window.addEventListener('DOMContentLoaded', function(){ window.showToast(@json(session('success')), 'success'); });</script>
@endif
@if(session('error'))
<script>window.addEventListener('DOMContentLoaded', function(){ window.showToast(@json(session('error')), 'error'); });</script>
@endif
@if($errors->any())
<script>window.addEventListener('DOMContentLoaded', function(){ window.showToast('Terjadi kesalahan validasi. Silakan cek form Anda.', 'error'); });</script>
@endif 