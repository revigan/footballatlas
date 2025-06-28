@extends('layouts.app')

@section('title', 'Prestasi Tim Nasional ' . $negara->nama)

@section('content')
<style>
    .glass-card {
        background: rgba(255,255,255,0.93);
        border-radius: 1.5rem;
        border: 1.5px solid #e0e7ef;
        box-shadow: 0 8px 32px rgba(99,102,241,0.13);
        backdrop-filter: blur(14px);
    }
    .badge-kode {
        font-size: 1.1rem;
        letter-spacing: 1px;
        font-weight: 600;
        padding: 0.5em 1.2em;
        background: #1e293b;
        color: #fff;
        border-radius: 0.7rem;
        margin-right: 0.5em;
    }
    .badge-konf {
        font-size: 1.1rem;
        font-weight: 700;
        padding: 0.5em 1.2em;
        border-radius: 1.2rem;
        margin-right: 0.5em;
        letter-spacing: 1px;
        box-shadow: 0 2px 8px rgba(99,102,241,0.10);
    }
    .achievement-badge {
        background: rgba(255,255,255,0.2);
        border-radius: 0.7rem;
        padding: 0.85rem 1.2rem;
        margin-bottom: 0.5rem;
        backdrop-filter: blur(10px);
        box-shadow: 0 1px 4px rgba(99,102,241,0.08);
        transition: transform 0.15s, box-shadow 0.15s;
    }
    .achievement-badge:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 16px rgba(99,102,241,0.10);
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
</style>
<div class="container py-5">
    <div class="glass-card p-5 mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <div>
                <h3 class="mb-1 fw-bold text-primary">Prestasi Tim Nasional {{ $negara->nama }}</h3>
                <span class="badge badge-kode">{{ $negara->kode_negara }}</span>
                @php
                    $confColors = [
                        'AFC' => 'success',
                        'CAF' => 'dark',
                        'CONCACAF' => 'info',
                        'CONMEBOL' => 'warning',
                        'OFC' => 'secondary',
                        'UEFA' => 'primary',
                    ];
                @endphp
                <span class="badge badge-konf bg-{{ $confColors[$negara->konfederasi] ?? 'secondary' }} text-uppercase">{{ $negara->konfederasi }}</span>
            </div>
            <a href="{{ route('negara.show', $negara->id) }}" class="btn btn-gradient"><i class="bi bi-arrow-left"></i> Kembali ke Detail Negara</a>
        </div>
        @if($prestasi->count() > 0)
            <div class="row g-3 justify-content-center">
                @foreach($prestasi as $p)
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="achievement-badge d-flex flex-column align-items-center text-center h-100">
                        <span class="mb-1" style="font-size:2rem;"><i class="bi bi-trophy text-success"></i></span>
                        <strong class="fs-6 mb-1">{{ $p->nama_prestasi }}</strong>
                        <span class="badge bg-light text-dark mb-2">{{ $p->tahun }}</span>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <form action="{{ route('prestasi-negara.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
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
                <p class="mb-0 mt-2">Belum ada data prestasi tim nasional</p>
            </div>
        @endif
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('negara.show', $negara->id) }}" class="btn btn-gradient btn-lg rounded-pill px-5"><i class="bi bi-arrow-left"></i> Kembali</a>
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