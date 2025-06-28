@extends('layouts.app')

@section('title', 'Tambah Negara')

@section('content')
<style>
    .glass-card {
        background: rgba(255,255,255,0.97);
        border-radius: 1.2rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 24px rgba(99,102,241,0.07);
    }
    .gradient-header {
        background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
        border-radius: 1rem;
        color: #fff;
        padding: 1.5rem 1.5rem 1.2rem 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 4px 24px rgba(99,102,241,0.10);
    }
    .gradient-header .bi {
        font-size: 2.2rem;
        opacity: 0.9;
    }
    .btn-gradient {
        background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
        color: #fff;
        border: none;
        border-radius: 0.5rem;
    }
    .btn-gradient:hover {
        color: #fff;
        background: linear-gradient(90deg, #4338ca 0%, #2563eb 100%);
    }
    .preview-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 0.5rem;
        border: 2px solid #e2e8f0;
        margin-bottom: 1rem;
        background: #f3f4f6;
    }
</style>
<div class="container py-4 d-flex align-items-center justify-content-center min-vh-80">
    <div class="col-md-8 col-lg-6">
        <div class="card glass-card border-0 p-4">
            <div class="gradient-header mb-3">
                <i class="bi bi-flag"></i>
                <div>
                    <h4 class="mb-0">Tambah Negara</h4>
                    <small class="text-light opacity-75">Masukkan data negara sepak bola baru</small>
                </div>
            </div>
            <div class="card-body p-0">
                <form action="{{ route('negara.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4 text-center">
                        <img id="preview" class="preview-img d-none" alt="Preview Bendera">
                    </div>
                    <div class="mb-4">
                        <label for="foto_negara" class="form-label">Bendera/Lambang Negara</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-image"></i></span>
                            <input type="file" class="form-control @error('foto_negara') is-invalid @enderror" id="foto_negara" name="foto_negara" accept="image/*" onchange="previewImage(event)">
                        </div>
                        @error('foto_negara')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="nama" class="form-label">Nama Negara</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-flag"></i></span>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Contoh: Indonesia">
                        </div>
                        @error('nama')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="kode_negara" class="form-label">Kode Negara (3 Huruf/ISO)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-123"></i></span>
                            <input type="text" class="form-control @error('kode_negara') is-invalid @enderror" id="kode_negara" name="kode_negara" value="{{ old('kode_negara') }}" required placeholder="Contoh: IDN" maxlength="3">
                        </div>
                        @error('kode_negara')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="konfederasi" class="form-label">Konfederasi</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-globe"></i></span>
                            <select class="form-select @error('konfederasi') is-invalid @enderror" id="konfederasi" name="konfederasi" required>
                                <option value="">-- Pilih Konfederasi --</option>
                                <option value="AFC" {{ old('konfederasi') == 'AFC' ? 'selected' : '' }}>AFC (Asia)</option>
                                <option value="CAF" {{ old('konfederasi') == 'CAF' ? 'selected' : '' }}>CAF (Afrika)</option>
                                <option value="CONCACAF" {{ old('konfederasi') == 'CONCACAF' ? 'selected' : '' }}>CONCACAF (Amerika Utara & Tengah)</option>
                                <option value="CONMEBOL" {{ old('konfederasi') == 'CONMEBOL' ? 'selected' : '' }}>CONMEBOL (Amerika Selatan)</option>
                                <option value="OFC" {{ old('konfederasi') == 'OFC' ? 'selected' : '' }}>OFC (Oseania)</option>
                                <option value="UEFA" {{ old('konfederasi') == 'UEFA' ? 'selected' : '' }}>UEFA (Eropa)</option>
                            </select>
                        </div>
                        @error('konfederasi')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('negara.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-gradient"><i class="bi bi-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.classList.add('d-none');
    }
}
</script>
@endsection 