@extends('layouts.app')

@section('title', $negara->nama)

@section('content')
<style>
    .glass-card {
        background: rgba(255,255,255,0.93);
        border-radius: 1.5rem;
        border: 1.5px solid #e0e7ef;
        box-shadow: 0 8px 32px rgba(99,102,241,0.13);
        backdrop-filter: blur(14px);
    }
    .country-header {
        background: linear-gradient(135deg, #6366f1 0%, #60a5fa 100%);
        color: white;
        border-radius: 2rem;
        padding: 2.5rem 2rem 2rem 2rem;
        margin-bottom: 2.5rem;
        text-align: center;
        box-shadow: 0 8px 32px rgba(99,102,241,0.13);
        position: relative;
    }
    .flag-container {
        width: 130px;
        height: 130px;
        border-radius: 1.2rem;
        background: #f1f5f9;
        border: 3px solid #e2e8f0;
        margin: 0 auto 1rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.13);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .flag-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
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
    .stat-card {
        background: rgba(255,255,255,0.7);
        color: #222;
        border-radius: 1.2rem;
        padding: 1.5rem 1.2rem;
        text-align: center;
        box-shadow: 0 2px 8px rgba(99,102,241,0.04);
        margin-bottom: 1rem;
        transition: transform 0.18s, box-shadow 0.18s;
        border: 1px solid #e0e7ef;
    }
    .stat-card:hover {
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 6px 24px rgba(99,102,241,0.13);
    }
    .stat-number {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    .stat-label {
        font-size: 1rem;
        opacity: 0.85;
    }
    .btn-gradient {
        background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
        color: #fff;
        border: none;
        border-radius: 2rem;
        padding: 0.6rem 2rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(99,102,241,0.10);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-gradient:hover {
        background: linear-gradient(90deg, #60a5fa 0%, #6366f1 100%);
        color: #fff;
        box-shadow: 0 6px 24px rgba(99,102,241,0.18);
    }
    .info-card, .clubs-card, .prestasi-nasional-card {
        background: rgba(255,255,255,0.7);
        color: #222;
        border-radius: 1.2rem;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(99,102,241,0.04);
        border: 1px solid #e0e7ef;
    }
    .achievement-badge, .club-badge {
        background: rgba(255,255,255,0.2);
        border-radius: 0.7rem;
        padding: 0.85rem 1.2rem;
        margin-bottom: 0.5rem;
        backdrop-filter: blur(10px);
        box-shadow: 0 1px 4px rgba(99,102,241,0.08);
    }
    .achievement-badge:hover, .club-badge:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 16px rgba(99,102,241,0.10);
    }
</style>

<div class="container py-5">
    <!-- Header Negara -->
    <div class="country-header mb-5">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                @if($negara->foto_negara)
                    <div class="flag-container">
                        <img src="{{ asset('storage/' . $negara->foto_negara) }}" alt="Bendera {{ $negara->nama }}">
                    </div>
                @else
                    <div class="flag-container">
                        <i class="bi bi-flag-fill" style="font-size: 3rem; color: #6366f1;"></i>
                    </div>
                @endif
            </div>
            <div class="col-md-9">
                <h1 class="mb-2 fw-bold" style="font-size:2.5rem; letter-spacing:0.01em;">{{ $negara->nama }}</h1>
                <div class="mb-3">
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
                <div class="d-flex justify-content-center gap-2 flex-wrap">
                    <a href="{{ route('negara.index') }}" class="btn btn-gradient btn-sm rounded-pill px-4">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('negara.edit', $negara->id) }}" class="btn btn-warning btn-sm rounded-pill px-4">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Negara -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-number"><i class="bi bi-shield text-primary me-2"></i>{{ $negara->klub ? $negara->klub->count() : 0 }}</div>
                <div class="stat-label">Total Klub</div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-number"><i class="bi bi-trophy text-warning me-2"></i>{{ $negara->prestasiNegara->count() }}</div>
                <div class="stat-label">Total Prestasi Negara</div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Prestasi Tim Nasional -->
        <div class="col-md-6 mb-4">
            <div class="glass-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="bi bi-trophy text-success me-2"></i>Prestasi Tim Nasional</h5>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalPrestasiNegara">
                        <i class="bi bi-plus-circle me-1"></i>Tambah
                    </button>
                    @endif
                </div>

                @if($negara->prestasiNegara && $negara->prestasiNegara->count() > 0)
                    <div class="prestasi-nasional-card">
                        @foreach($negara->prestasiNegara->sortByDesc('tahun')->take(3) as $p)
                        <div class="achievement-badge">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $p->nama_prestasi }}</strong>
                                </div>
                                <span class="badge bg-light text-dark">{{ $p->tahun }}</span>
                                @if(auth()->check() && auth()->user()->role === 'admin')
                                <form action="{{ route('prestasi-negara.destroy', $p->id) }}" method="POST" class="d-inline ms-2" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @if($negara->prestasiNegara->count() > 3)
                        <div class="text-center mt-2">
                            <a href="{{ route('negara.prestasi', $negara->id) }}" class="btn btn-gradient btn-sm rounded-pill px-4"><i class="bi bi-list"></i> Lainnya</a>
                        </div>
                        @endif
                    </div>
                @else
                    <div class="prestasi-nasional-card text-center">
                        <i class="bi bi-trophy" style="font-size: 3rem; opacity: 0.5;"></i>
                        <p class="mb-0 mt-2">Belum ada data prestasi tim nasional.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Daftar Klub -->
        <div class="col-md-6 mb-4">
            <div class="glass-card p-4">
                <h5 class="mb-3"><i class="bi bi-shield text-warning me-2"></i>Daftar Klub</h5>
                
                @if($negara->klub && $negara->klub->count() > 0)
                    <div class="clubs-card">
                        <div class="row">
                            <div class="col-12">
                                @foreach($negara->klub->take(5) as $klub)
                                <div class="club-badge">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <a href="{{ route('klub.show', $klub->id) }}" class="fw-bold text-decoration-none text-dark">
                                                {{ $klub->nama }}
                                            </a>
                                            <br><small class="opacity-75">{{ $klub->tahun_berdiri ?? 'Tahun tidak diketahui' }}</small>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-warning text-dark">{{ $klub->prestasi ? $klub->prestasi->count() : 0 }} prestasi</span>
                                            <br><small class="opacity-75">{{ $klub->stadion ?? 'Stadion tidak diketahui' }}</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @if($negara->klub->count() > 5)
                                <div class="text-center mt-2">
                                    <small class="opacity-75">+{{ $negara->klub->count() - 5 }} klub lainnya</small>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="clubs-card text-center">
                        <i class="bi bi-shield" style="font-size: 3rem; opacity: 0.5;"></i>
                        <p class="mb-0 mt-2">Belum ada data klub</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if(auth()->check() && auth()->user()->role === 'admin')
<!-- Modal Tambah Prestasi Negara-->
<div class="modal fade" id="modalPrestasiNegara" tabindex="-1" aria-labelledby="modalPrestasiNegaraLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('prestasi-negara.store', $negara->id) }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalPrestasiNegaraLabel">
            <i class="bi bi-trophy text-success me-2"></i>Tambah Prestasi Tim Nasional
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_prestasi" class="form-label">Nama Prestasi</label>
            <input type="text" class="form-control" name="nama_prestasi" required>
          </div>
          <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="text" class="form-control" name="tahun" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif

@if(session('success'))
    <script>window.addEventListener('DOMContentLoaded', function(){ window.showToast(@json(session('success')), 'success'); });</script>
@endif
@if(session('error'))
    <script>window.addEventListener('DOMContentLoaded', function(){ window.showToast(@json(session('error')), 'error'); });</script>
@endif
@if($errors->any())
    <script>window.addEventListener('DOMContentLoaded', function(){ window.showToast('Terjadi kesalahan validasi. Silakan cek form Anda.', 'error'); });</script>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Animasi progress ring
  const progressRing = document.querySelector('.progress-ring .progress');
  if (progressRing) {
    const radius = progressRing.r.baseVal.value;
    const circumference = radius * 2 * Math.PI;
    progressRing.style.strokeDasharray = circumference;
    progressRing.style.strokeDashoffset = circumference;
    
    // Set progress (contoh: 80%)
    const progress = 80;
    const offset = circumference - (progress / 100) * circumference;
    progressRing.style.strokeDashoffset = offset;
  }
});
</script>
@endpush
@endsection 