@extends('layouts.app')

@section('title', $klub->nama)

@section('content')
<style>
    .glass-card {
        background: rgba(255,255,255,0.90);
        border-radius: 1.5rem;
        border: 1.5px solid #e0e7ef;
        box-shadow: 0 8px 32px rgba(99,102,241,0.10);
        backdrop-filter: blur(12px);
    }
    .club-header {
        background: linear-gradient(135deg, #6366f1 0%, #60a5fa 100%);
        color: white;
        border-radius: 2rem;
        padding: 2.5rem 2rem 2rem 2rem;
        margin-bottom: 2.5rem;
        text-align: center;
        box-shadow: 0 8px 32px rgba(99,102,241,0.13);
        position: relative;
    }
    .logo-klub {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border-radius: 1.2rem;
        background: #f1f5f9;
        border: 3px solid #e2e8f0;
        margin-bottom: 1rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.13);
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
    .info-card, .prestasi-card {
        background: rgba(255,255,255,0.7);
        color: #222;
        border-radius: 1.2rem;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(99,102,241,0.04);
        border: 1px solid #e0e7ef;
    }
    .achievement-badge {
        background: rgba(255,255,255,0.2);
        border-radius: 0.7rem;
        padding: 0.85rem 1.2rem;
        margin-bottom: 0.5rem;
        backdrop-filter: blur(10px);
        box-shadow: 0 1px 4px rgba(99,102,241,0.08);
    }
    .achievement-badge:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 16px rgba(99,102,241,0.10);
    }
    .progress-ring {
        width: 80px;
        height: 80px;
        margin: 0 auto 1rem;
    }
    .progress-ring circle {
        fill: none;
        stroke-width: 4;
        stroke-linecap: round;
    }
    .progress-ring .bg {
        stroke: rgba(255,255,255,0.2);
    }
    .progress-ring .progress {
        stroke: #fff;
        stroke-dasharray: 251.2;
        stroke-dashoffset: 125.6;
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
    }
</style>

<div class="container py-5">
    <!-- Header Klub -->
    <div class="club-header mb-5">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                @if($klub->logo_klub)
                    <img src="{{ asset('storage/' . $klub->logo_klub) }}" class="logo-klub" alt="Logo {{ $klub->nama }}">
                @else
                    <div class="logo-klub d-flex align-items-center justify-content-center">
                        <i class="bi bi-shield-fill" style="font-size: 3rem; color: #6366f1;"></i>
                    </div>
                @endif
            </div>
            <div class="col-md-9">
                <h1 class="mb-2 fw-bold" style="font-size:2.5rem; letter-spacing:0.01em;">{{ $klub->nama }}</h1>
                <p class="mb-3 opacity-75 fs-5">
                    <i class="bi bi-geo-alt me-2"></i>
                    {{ $klub->negara->nama ?? 'Negara tidak diketahui' }}
                </p>
                <div class="d-flex justify-content-center gap-2 flex-wrap">
                    <a href="{{ route('klub.index') }}" class="btn btn-gradient btn-sm rounded-pill px-4">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('klub.edit', $klub->id) }}" class="btn btn-warning btn-sm rounded-pill px-4">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Klub -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-number"><i class="bi bi-calendar3 text-primary me-2"></i>{{ $klub->tahun_berdiri ?? 'N/A' }}</div>
                <div class="stat-label">Tahun Berdiri</div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-number"><i class="bi bi-trophy text-warning me-2"></i>{{ $klub->prestasi ? $klub->prestasi->count() : 0 }}</div>
                <div class="stat-label">Total Prestasi</div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <div class="stat-number"><i class="bi bi-hourglass-split text-info me-2"></i>
                    @php
                        $usia = $klub->tahun_berdiri ? (date('Y') - $klub->tahun_berdiri) : 0;
                    @endphp
                    {{ $usia > 0 ? $usia : 'N/A' }}
                </div>
                <div class="stat-label">Usia Klub (Tahun)</div>
            </div>
        </div>
    </div>

    <!-- Breakdown Prestasi -->
    @if($klub->prestasi && $klub->prestasi->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="glass-card p-4">
                <h5 class="mb-3"><i class="bi bi-pie-chart text-primary me-2"></i>Breakdown Prestasi</h5>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <div class="text-center">
                            <div class="stat-number text-warning">{{ $klub->prestasi->where('kategori', 'Liga')->count() }}</div>
                            <div class="stat-label">Liga</div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="text-center">
                            <div class="stat-number text-info">{{ $klub->prestasi->where('kategori', 'Cup')->count() }}</div>
                            <div class="stat-label">Cup</div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="text-center">
                            <div class="stat-number text-success">{{ $klub->prestasi->where('kategori', 'League Cup')->count() }}</div>
                            <div class="stat-label">League Cup</div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="text-center">
                            <div class="stat-number text-primary">{{ $klub->prestasi->where('kategori', 'Super Cup')->count() }}</div>
                            <div class="stat-label">Super Cup</div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="text-center">
                            <div class="stat-number text-danger">{{ $klub->prestasi->where('kategori', 'Piala Internasional')->count() }}</div>
                            <div class="stat-label">Piala Internasional</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <!-- Informasi Klub -->
        <div class="col-md-6 mb-4">
            <div class="glass-card p-4">
                <h5 class="mb-3"><i class="bi bi-info-circle text-primary me-2"></i>Informasi Klub</h5>
                <div class="info-card">
                    <div class="row">
                        <div class="col-6">
                            <strong>Nama Klub:</strong><br>
                            <span class="opacity-75">{{ $klub->nama }}</span>
                        </div>
                        <div class="col-6">
                            <strong>Negara:</strong><br>
                            <span class="opacity-75">{{ $klub->negara->nama ?? 'Tidak diketahui' }}</span>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="row">
                        <div class="col-6">
                            <strong>Tahun Berdiri:</strong><br>
                            <span class="opacity-75">{{ $klub->tahun_berdiri ?? 'Tidak diketahui' }}</span>
                        </div>
                        <div class="col-6">
                            <strong>Stadion:</strong><br>
                            <span class="opacity-75">{{ $klub->stadion ?? 'Tidak diketahui' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prestasi Klub -->
        <div class="col-md-6 mb-4">
            <div class="glass-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="bi bi-trophy text-warning me-2"></i>Prestasi Klub</h5>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalPrestasi">
                        <i class="bi bi-plus-circle me-1"></i>Tambah
                    </button>
                    @endif
                </div>
                
                @if($klub->prestasi && $klub->prestasi->count() > 0)
                    <div class="prestasi-card">
                        <div class="row">
                            <div class="col-12">
                                <!-- Liga -->
                                @php $ligaPrestasi = $klub->prestasi->where('kategori', 'Liga'); @endphp
                                @if($ligaPrestasi->count() > 0)
                                <div class="mb-3">
                                    <h6 class="mb-2"><i class="bi bi-award text-warning me-1"></i>Liga</h6>
                                    @foreach($ligaPrestasi->take(2) as $p)
                                    <div class="achievement-badge">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $p->nama_prestasi }}</strong>
                                                <br><small class="opacity-75">{{ $p->tahun }}</small>
                                            </div>
                                            <span class="badge bg-warning text-dark">Liga</span>
                                            @if(auth()->check() && auth()->user()->role === 'admin')
                                            <form action="{{ route('prestasi.destroy', $p->id) }}" method="POST" class="d-inline ms-2" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @if($ligaPrestasi->count() > 2)
                                    <div class="text-center mt-2">
                                        <a href="{{ route('klub.prestasi', ['klub' => $klub->id, 'kategori' => 'Liga']) }}" class="btn btn-gradient btn-sm rounded-pill px-4"><i class="bi bi-list"></i> Lainnya</a>
                                    </div>
                                    @endif
                                </div>
                                @endif

                                <!-- Cup -->
                                @php $cupPrestasi = $klub->prestasi->where('kategori', 'Cup'); @endphp
                                @if($cupPrestasi->count() > 0)
                                <div class="mb-3">
                                    <h6 class="mb-2"><i class="bi bi-cup text-info me-1"></i>Cup</h6>
                                    @foreach($cupPrestasi->take(2) as $p)
                                    <div class="achievement-badge">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $p->nama_prestasi }}</strong>
                                                <br><small class="opacity-75">{{ $p->tahun }}</small>
                                            </div>
                                            <span class="badge bg-info text-white">Cup</span>
                                            @if(auth()->check() && auth()->user()->role === 'admin')
                                            <form action="{{ route('prestasi.destroy', $p->id) }}" method="POST" class="d-inline ms-2" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @if($cupPrestasi->count() > 2)
                                    <div class="text-center mt-2">
                                        <a href="{{ route('klub.prestasi', ['klub' => $klub->id, 'kategori' => 'Cup']) }}" class="btn btn-gradient btn-sm rounded-pill px-4"><i class="bi bi-list"></i> Lainnya</a>
                                    </div>
                                    @endif
                                </div>
                                @endif

                                <!-- League Cup -->
                                @php $leagueCupPrestasi = $klub->prestasi->where('kategori', 'League Cup'); @endphp
                                @if($leagueCupPrestasi->count() > 0)
                                <div class="mb-3">
                                    <h6 class="mb-2"><i class="bi bi-trophy text-success me-1"></i>League Cup</h6>
                                    @foreach($leagueCupPrestasi->take(2) as $p)
                                    <div class="achievement-badge">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $p->nama_prestasi }}</strong>
                                                <br><small class="opacity-75">{{ $p->tahun }}</small>
                                            </div>
                                            <span class="badge bg-success text-white">League Cup</span>
                                            @if(auth()->check() && auth()->user()->role === 'admin')
                                            <form action="{{ route('prestasi.destroy', $p->id) }}" method="POST" class="d-inline ms-2" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @if($leagueCupPrestasi->count() > 2)
                                    <div class="text-center mt-2">
                                        <a href="{{ route('klub.prestasi', ['klub' => $klub->id, 'kategori' => 'League Cup']) }}" class="btn btn-gradient btn-sm rounded-pill px-4"><i class="bi bi-list"></i> Lainnya</a>
                                    </div>
                                    @endif
                                </div>
                                @endif

                                <!-- Piala Internasional -->
                                @php $internasionalPrestasi = $klub->prestasi->where('kategori', 'Piala Internasional'); @endphp
                                @if($internasionalPrestasi->count() > 0)
                                <div class="mb-3">
                                    <h6 class="mb-2"><i class="bi bi-globe text-danger me-1"></i>Piala Internasional</h6>
                                    @foreach($internasionalPrestasi->take(2) as $p)
                                    <div class="achievement-badge">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $p->nama_prestasi }}</strong>
                                                <br><small class="opacity-75">{{ $p->tahun }}</small>
                                            </div>
                                            <span class="badge bg-danger text-white">Internasional</span>
                                            @if(auth()->check() && auth()->user()->role === 'admin')
                                            <form action="{{ route('prestasi.destroy', $p->id) }}" method="POST" class="d-inline ms-2" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @if($internasionalPrestasi->count() > 2)
                                    <div class="text-center mt-2">
                                        <a href="{{ route('klub.prestasi', ['klub' => $klub->id, 'kategori' => 'Piala Internasional']) }}" class="btn btn-gradient btn-sm rounded-pill px-4"><i class="bi bi-list"></i> Lainnya</a>
                                    </div>
                                    @endif
                                </div>
                                @endif

                                <!-- Super Cup -->
                                @php $superCupPrestasi = $klub->prestasi->where('kategori', 'Super Cup'); @endphp
                                @if($superCupPrestasi->count() > 0)
                                <div class="mb-3">
                                    <h6 class="mb-2"><i class="bi bi-star text-primary me-1"></i>Super Cup</h6>
                                    @foreach($superCupPrestasi->take(2) as $p)
                                    <div class="achievement-badge">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $p->nama_prestasi }}</strong>
                                                <br><small class="opacity-75">{{ $p->tahun }}</small>
                                            </div>
                                            <span class="badge bg-primary text-white">Super Cup</span>
                                            @if(auth()->check() && auth()->user()->role === 'admin')
                                            <form action="{{ route('prestasi.destroy', $p->id) }}" method="POST" class="d-inline ms-2" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @if($superCupPrestasi->count() > 2)
                                    <div class="text-center mt-2">
                                        <a href="{{ route('klub.prestasi', ['klub' => $klub->id, 'kategori' => 'Super Cup']) }}" class="btn btn-gradient btn-sm rounded-pill px-4"><i class="bi bi-list"></i> Lainnya</a>
                                    </div>
                                    @endif
                                </div>
                                @endif

                                <!-- Total Prestasi -->
                                <div class="text-center mt-3 pt-2 border-top">
                                    <small class="opacity-75">
                                        Total: {{ $klub->prestasi->count() }} prestasi
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="prestasi-card text-center">
                        <i class="bi bi-trophy" style="font-size: 3rem; opacity: 0.5;"></i>
                        <p class="mb-0 mt-2">Belum ada data prestasi</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@if(session('success'))
<script>window.addEventListener('DOMContentLoaded', function(){ window.showToast(@json(session('success')), 'success'); });</script>
@endif
@if(session('error'))
<script>window.addEventListener('DOMContentLoaded', function(){ window.showToast(@json(session('error')), 'error'); });</script>
@endif
@if($errors->any())
<script>window.addEventListener('DOMContentLoaded', function(){ window.showToast('Terjadi kesalahan validasi. Silakan cek form Anda.', 'error'); });</script>
@endif

@if(auth()->check() && auth()->user()->role === 'admin')
<!-- Modal Tambah Prestasi -->
<div class="modal fade" id="modalPrestasi" tabindex="-1" aria-labelledby="modalPrestasiLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('prestasi.store', $klub->id) }}" id="formPrestasi">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalPrestasiLabel">
            <i class="bi bi-trophy text-warning me-2"></i>Tambah Prestasi Klub
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_prestasi" class="form-label">Nama Prestasi</label>
            <input type="text" class="form-control @error('nama_prestasi') is-invalid @enderror" 
                   id="nama_prestasi" name="nama_prestasi" 
                   placeholder="Contoh: Juara Liga 1" value="{{ old('nama_prestasi') }}">
            @error('nama_prestasi')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori Prestasi</label>
            <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
                <option value="">Pilih Kategori</option>
                <option value="Liga" {{ old('kategori') == 'Liga' ? 'selected' : '' }}>Liga</option>
                <option value="Cup" {{ old('kategori') == 'Cup' ? 'selected' : '' }}>Cup</option>
                <option value="League Cup" {{ old('kategori') == 'League Cup' ? 'selected' : '' }}>League Cup</option>
                <option value="Piala Internasional" {{ old('kategori') == 'Piala Internasional' ? 'selected' : '' }}>Piala Internasional</option>
                <option value="Super Cup" {{ old('kategori') == 'Super Cup' ? 'selected' : '' }}>Super Cup</option>
            </select>
            @error('kategori')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="tahun_prestasi" class="form-label">Tahun</label>
            <input type="number" class="form-control @error('tahun') is-invalid @enderror" 
                   id="tahun_prestasi" name="tahun" 
                   placeholder="Contoh: 2023" value="{{ old('tahun') }}" 
                   min="1900" max="{{ date('Y') + 1 }}">
            @error('tahun')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle me-1"></i>Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif

@if($errors->has('nama_prestasi') || $errors->has('tahun') || $errors->has('kategori'))
    <script>window.bladeError = true;</script>
@else
    <script>window.bladeError = false;</script>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Buka modal otomatis jika ada error validasi
  if (window.bladeError) {
    var modal = new bootstrap.Modal(document.getElementById('modalPrestasi'));
    modal.show();
  }
  
  // Reset form hanya jika tidak ada error validasi
  var modalEl = document.getElementById('modalPrestasi');
  if (modalEl) {
    modalEl.addEventListener('hidden.bs.modal', function () {
      if (!window.bladeError) {
        document.getElementById('formPrestasi').reset();
      }
    });
  }

  // Animasi progress ring
  const progressRing = document.querySelector('.progress-ring .progress');
  if (progressRing) {
    const radius = progressRing.r.baseVal.value;
    const circumference = radius * 2 * Math.PI;
    progressRing.style.strokeDasharray = circumference;
    progressRing.style.strokeDashoffset = circumference;
    
    // Set progress (contoh: 75%)
    const progress = 75;
    const offset = circumference - (progress / 100) * circumference;
    progressRing.style.strokeDashoffset = offset;
  }
});
</script>
@endpush 