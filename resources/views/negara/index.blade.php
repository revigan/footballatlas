@extends('layouts.app')

@section('title', 'Daftar Negara')

@section('content')
<style>
    .glass-card {
        background: rgba(255,255,255,0.93);
        border-radius: 1.5rem;
        border: 1.5px solid #e0e7ef;
        box-shadow: 0 8px 32px rgba(99,102,241,0.13);
        backdrop-filter: blur(14px);
    }
    .gradient-header {
        background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
        border-radius: 1.3rem;
        color: #fff;
        padding: 2rem 2rem 1.5rem 2rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1.2rem;
        box-shadow: 0 8px 32px rgba(99,102,241,0.13);
    }
    .gradient-header .bi {
        font-size: 2.5rem;
        opacity: 0.92;
    }
    .btn-gradient {
        background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
        color: #fff;
        border: none;
        border-radius: 1.2rem;
        padding: 0.7rem 2.2rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(99,102,241,0.10);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-gradient:hover {
        color: #fff;
        background: linear-gradient(90deg, #4338ca 0%, #2563eb 100%);
        box-shadow: 0 6px 24px rgba(99,102,241,0.18);
    }
    .search-card {
        background: #fff;
        border-radius: 1.2rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(99,102,241,0.04);
    }
    .table thead th {
        position: sticky;
        top: 0;
        background: #f8fafc;
        z-index: 2;
        border-top: none;
        font-weight: 600;
        padding: 1rem 0.75rem;
        color: #1e293b;
    }
    .table td {
        padding: 0.875rem 0.75rem;
        border-bottom-color: #e2e8f0;
    }
    .badge-konf {
        font-weight: 700;
        font-size: 1rem;
        padding: 0.5em 1.2em;
        border-radius: 1.2rem;
        letter-spacing: 1px;
        box-shadow: 0 2px 8px rgba(99,102,241,0.10);
    }
    .country-flag {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 0.7rem;
        background: #f1f5f9;
        border: 2px solid #e2e8f0;
    }
    .country-code {
        background: #1e293b;
        color: #fff;
        font-size: 1rem;
        padding: 0.45em 1em;
        border-radius: 0.7rem;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    .btn-action {
        padding: 0.45rem 0.9rem;
        font-size: 1rem;
        border-radius: 0.7rem;
    }
    @media (max-width: 768px) {
        .table-responsive { font-size: 0.97rem; }
        .btn-group .btn { padding: 0.35rem 0.5rem; }
        .btn-group .btn span { display: none; }
        .badge-konf { font-size: 0.8rem; padding: 0.35em 0.75em; }
    }
</style>
<div class="container py-5">
    <div class="gradient-header mb-4">
        <i class="bi bi-flag"></i>
        <div>
            <h3 class="mb-0 fw-bold">Daftar Negara</h3>
            <small class="text-light opacity-75">List negara sepak bola dunia</small>
        </div>
    </div>
    <div class="search-card p-4 mb-4">
        <form method="GET" class="row g-2 align-items-center justify-content-end mb-0">
            <div class="col-auto">
                <input type="text" name="search" class="form-control" placeholder="Cari negara/kode..." value="{{ $search ?? '' }}" style="min-width: 200px; border-radius:0.7rem;">
            </div>
            <div class="col-auto">
                <select name="konfederasi" class="form-select" style="min-width: 150px; border-radius:0.7rem;">
                    <option value="">Semua Konfederasi</option>
                    @foreach($konfederasiList as $k)
                        <option value="{{ $k }}" {{ (isset($filter) && $filter == $k) ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-gradient px-3" type="submit"><i class="bi bi-search"></i></button>
            </div>
            @if(!empty($search) || !empty($filter))
            <div class="col-auto">
                <a href="{{ route('negara.index') }}" class="btn btn-secondary rounded-pill px-4">Reset</a>
            </div>
            @endif
            <div class="col-auto ms-auto">
                @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('negara.create') }}" class="btn btn-gradient px-4 rounded-pill">
                    <i class="bi bi-plus-circle me-1"></i>
                    <span class="d-none d-sm-inline">Tambah Negara</span>
                </a>
                @endif
            </div>
        </form>
    </div>
    @if(session('success'))
        <div id="success-message" data-message="{{ session('success') }}" style="display: none;"></div>
    @endif
    <div class="glass-card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px;">No</th>
                        <th class="text-center" style="width: 80px;">Bendera</th>
                        <th>Nama Negara</th>
                        <th class="text-center" style="width: 100px;">Kode</th>
                        <th class="text-center">Konfederasi</th>
                        <th class="text-center" style="width: 120px;">Jumlah Klub</th>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <th class="text-center" style="width: 140px;">Aksi</th>
                        @else
                        <th class="text-center" style="width: 140px;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($negara as $index => $n)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">
                            @if($n->foto_negara)
                                <img src="{{ asset('storage/' . $n->foto_negara) }}" alt="Bendera {{ $n->nama }}" class="country-flag">
                            @else
                                <span class="text-muted"><i class="bi bi-image"></i></span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('negara.show', $n->id) }}" class="text-decoration-none fw-bold text-dark">{{ $n->nama }}</a>
                        </td>
                        <td class="text-center">
                            <span class="country-code">{{ $n->kode_negara }}</span>
                        </td>
                        <td class="text-center">
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
                            <span class="badge badge-konf bg-{{ $confColors[$n->konfederasi] ?? 'secondary' }}">{{ $n->konfederasi }}</span>
                        </td>
                        <td class="text-center">{{ $n->klub->count() ?? 0 }}</td>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <td class="text-center">
                            <div class="btn-group gap-2" role="group">
                                <a href="{{ route('negara.show', $n->id) }}" class="btn btn-action btn-gradient text-white" title="Detail"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('negara.edit', $n->id) }}" class="btn btn-action btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('negara.destroy', $n->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-action btn-danger" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                        @else
                        <td class="text-center">
                            <a href="{{ route('negara.show', $n->id) }}" class="btn btn-action btn-gradient text-white" title="Detail"><i class="bi bi-eye"></i> <span class="d-none d-md-inline">Detail</span></a>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="@if(auth()->check() && auth()->user()->role === 'admin') 7 @else 6 @endif" class="text-center py-4">Tidak ada data negara</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    const konfederasiSelect = document.querySelector('select[name="konfederasi"]');
    const form = document.querySelector('form');
    let searchTimeout;
    
    // Show success message if exists
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
        const message = successMessage.getAttribute('data-message');
        if (message && window.showToast) {
            window.showToast(message, 'success');
        }
    }
    
    // Add loading indicator
    function showLoading() {
        const tbody = document.querySelector('tbody');
        if (tbody) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-4">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="spinner-border spinner-border-sm text-primary me-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <span class="text-muted">Mencari...</span>
                        </div>
                    </td>
                </tr>
            `;
        }
    }
    
    // Create new performLiveSearch with loading
    function performLiveSearchWithLoading() {
        showLoading();
        setTimeout(function() {
            const searchValue = searchInput.value.trim();
            const konfederasiValue = konfederasiSelect.value;
            
            // Build URL with current parameters
            let url = new URL(window.location);
            url.searchParams.set('search', searchValue);
            if (konfederasiValue) {
                url.searchParams.set('konfederasi', konfederasiValue);
            } else {
                url.searchParams.delete('konfederasi');
            }
            
            // Update URL without page reload
            window.history.pushState({}, '', url);
            
            // Fetch filtered results
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    // Create a temporary div to parse the HTML
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    // Extract table body content
                    const newTableBody = doc.querySelector('tbody');
                    const currentTableBody = document.querySelector('tbody');
                    
                    if (newTableBody && currentTableBody) {
                        currentTableBody.innerHTML = newTableBody.innerHTML;
                    }
                    
                    // Update result count if available
                    const resultCount = doc.querySelector('.result-count');
                    if (resultCount) {
                        const currentResultCount = document.querySelector('.result-count');
                        if (currentResultCount) {
                            currentResultCount.innerHTML = resultCount.innerHTML;
                        }
                    }
                })
                .catch(error => {
                    console.error('Live search error:', error);
                });
        }, 100);
    }
    
    // Debounced search on input change
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performLiveSearchWithLoading, 500);
    });
    
    // Live search on konfederasi change
    konfederasiSelect.addEventListener('change', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performLiveSearchWithLoading, 300);
    });
    
    // Prevent form submission on Enter key for live search
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            performLiveSearchWithLoading();
        }
    });
});
</script>
@endpush

@endsection