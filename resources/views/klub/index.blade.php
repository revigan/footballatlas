@extends('layouts.app')

@section('title', 'Daftar Klub')

@section('content')
<body data-is-admin="{{ auth()->check() && auth()->user()->role === 'admin' ? 'true' : 'false' }}">
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
    .logo-klub {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 0.7rem;
        background: #f1f5f9;
        border: 2px solid #e2e8f0;
    }
    .btn-action {
        padding: 0.45rem 0.9rem;
        font-size: 1rem;
        border-radius: 0.7rem;
    }
    .table thead th {
        background: rgba(99,102,241,0.07);
        font-weight: 600;
        border-top: none;
    }
    .table-hover tbody tr:hover {
        background: rgba(99,102,241,0.06);
    }
    .badge-negara {
        background: linear-gradient(90deg, #60a5fa 0%, #6366f1 100%);
        color: #fff;
        border-radius: 1.2rem;
        padding: 0.4em 1.1em;
        font-size: 0.95rem;
        font-weight: 500;
        letter-spacing: 0.02em;
    }
</style>
<div class="container py-5">
    <div class="gradient-header mb-4">
        <i class="bi bi-shield"></i>
        <div>
            <h3 class="mb-0 fw-bold">Daftar Klub</h3>
            <small class="text-light opacity-75">List klub sepak bola dunia</small>
        </div>
    </div>
    <div class="search-card p-4 mb-4">
        <form method="GET" class="row g-2 align-items-center justify-content-end mb-0">
            <div class="col-auto">
                <input type="text" name="search" class="form-control" placeholder="Cari klub/nama stadion..." value="{{ request('search') }}" style="min-width: 200px; border-radius:0.7rem;">
            </div>
            <div class="col-auto">
                <select name="negara_id" class="form-select" style="min-width: 150px; border-radius:0.7rem;">
                    <option value="">Semua Negara</option>
                    @foreach($negaraList as $n)
                        <option value="{{ $n->id }}" {{ request('negara_id') == $n->id ? 'selected' : '' }}>{{ $n->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-gradient px-3" type="submit"><i class="bi bi-search"></i></button>
            </div>
            @if(request('search') || request('negara_id'))
            <div class="col-auto">
                <a href="{{ route('klub.index') }}" class="btn btn-secondary rounded-pill px-4">Reset</a>
            </div>
            @endif
            <div class="col-auto ms-auto">
                @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('klub.create') }}" class="btn btn-gradient px-4 rounded-pill">
                    <i class="bi bi-plus-circle me-1"></i>
                    <span class="d-none d-sm-inline">Tambah Klub</span>
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
                        <th class="text-center" style="width:60px;">No</th>
                        <th class="text-center" style="width:60px;">Logo</th>
                        <th>Nama Klub</th>
                        <th>Tahun Berdiri</th>
                        <th>Stadion</th>
                        <th>Negara</th>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <th class="text-center" style="width:140px;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($klub as $i => $k)
                    <tr>
                        <td class="text-center">{{ $klub->firstItem() + $i }}</td>
                        <td class="text-center">
                            @if($k->logo_klub)
                                <img src="{{ asset('storage/' . $k->logo_klub) }}" class="logo-klub" alt="Logo {{ $k->nama }}">
                            @else
                                <span class="text-muted"><i class="bi bi-image"></i></span>
                            @endif
                        </td>
                        <td class="fw-bold text-dark">{{ $k->nama }}</td>
                        <td>{{ $k->tahun_berdiri ?? '-' }}</td>
                        <td>{{ $k->stadion ?? '-' }}</td>
                        <td><span class="badge-negara">{{ $k->negara->nama ?? '-' }}</span></td>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <td class="text-center">
                            <div class="btn-group gap-2" role="group">
                                <a href="{{ route('klub.show', $k->id) }}" class="btn btn-action btn-gradient text-white" title="Detail"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('klub.edit', $k->id) }}" class="btn btn-action btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('klub.destroy', $k->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-action btn-danger" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                        @else
                        <td class="text-center">
                            <a href="{{ route('klub.show', $k->id) }}" class="btn btn-action btn-gradient text-white" title="Detail"><i class="bi bi-eye"></i> <span class="d-none d-md-inline">Detail</span></a>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="@if(auth()->check() && auth()->user()->role === 'admin') 7 @else 6 @endif" class="text-center py-4">Tidak ada data klub</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $klub->links() }}
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    const negaraSelect = document.querySelector('select[name="negara_id"]');
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
            const isAdmin = document.body.getAttribute('data-is-admin') === 'true';
            const colspan = isAdmin ? 7 : 6;
            tbody.innerHTML = `
                <tr>
                    <td colspan="${colspan}" class="text-center py-4">
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
            const negaraValue = negaraSelect.value;
            
            // Build URL with current parameters
            let url = new URL(window.location);
            if (searchValue) {
                url.searchParams.set('search', searchValue);
            } else {
                url.searchParams.delete('search');
            }
            if (negaraValue) {
                url.searchParams.set('negara_id', negaraValue);
            } else {
                url.searchParams.delete('negara_id');
            }
            
            // Update URL without page reload
            window.history.pushState({}, '', url);
            
            // Fetch filtered results
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
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
                    
                    // Update pagination if available
                    const newPagination = doc.querySelector('.pagination');
                    const currentPagination = document.querySelector('.pagination');
                    if (newPagination && currentPagination) {
                        currentPagination.innerHTML = newPagination.innerHTML;
                    }
                    
                    // Update reset button visibility
                    const newResetBtn = doc.querySelector('a[href*="klub.index"]');
                    const currentResetBtn = document.querySelector('a[href*="klub.index"]');
                    if (newResetBtn && currentResetBtn) {
                        currentResetBtn.style.display = (searchValue || negaraValue) ? 'block' : 'none';
                    }
                })
                .catch(error => {
                    console.error('Live search error:', error);
                    // Show error message in table
                    const tbody = document.querySelector('tbody');
                    if (tbody) {
                        const isAdmin = document.body.getAttribute('data-is-admin') === 'true';
                        const colspan = isAdmin ? 7 : 6;
                        tbody.innerHTML = `
                            <tr>
                                <td colspan="${colspan}" class="text-center py-4">
                                    <div class="text-danger">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        Terjadi kesalahan saat mencari. Silakan coba lagi.
                                    </div>
                                </td>
                            </tr>
                        `;
                    }
                });
        }, 100);
    }
    
    // Debounced search on input change
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performLiveSearchWithLoading, 500);
    });
    
    // Live search on negara change
    negaraSelect.addEventListener('change', function() {
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