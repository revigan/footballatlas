@extends('layouts.app')

@section('title', 'Edit Klub')

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
        background: linear-gradient(90deg, #f59e42 0%, #fbbf24 100%);
        border-radius: 1.2rem;
        color: #fff;
        padding: 2rem 2rem 1.5rem 2rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1.2rem;
        box-shadow: 0 8px 32px rgba(251,191,36,0.13);
    }
    .gradient-header .bi {
        font-size: 2.5rem;
        opacity: 0.92;
    }
    .btn-gradient {
        background: linear-gradient(90deg, #f59e42 0%, #fbbf24 100%);
        color: #fff;
        border: none;
        border-radius: 1.2rem;
        padding: 0.7rem 2.2rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(251,191,36,0.10);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-gradient:hover {
        color: #fff;
        background: linear-gradient(90deg, #fbbf24 0%, #f59e42 100%);
        box-shadow: 0 6px 24px rgba(251,191,36,0.18);
    }
    .preview-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 0.7rem;
        border: 2px solid #e2e8f0;
        margin-bottom: 1rem;
        background: #f3f4f6;
    }
    .form-control, .form-select {
        border-radius: 0.7rem;
        font-size: 1.1rem;
        padding: 0.7rem 1.1rem;
    }
</style>
<div class="container py-5 d-flex align-items-center justify-content-center min-vh-80">
    <div class="col-md-8 col-lg-6">
        <div class="card glass-card border-0 p-5">
            <div class="gradient-header mb-4">
                <i class="bi bi-pencil-square"></i>
                <div>
                    <h3 class="mb-0">Edit Klub</h3>
                    <small class="text-light opacity-75">Perbarui data klub sepak bola</small>
                </div>
            </div>
            <div class="card-body p-0">
                <form action="{{ route('klub.update', $klub->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4 text-center">
                        @if($klub->logo_klub)
                            <img id="preview" src="{{ asset('storage/' . $klub->logo_klub) }}" class="preview-img" alt="Logo Klub">
                        @else
                            <img id="preview" class="preview-img d-none" alt="Preview Logo Klub">
                        @endif
                    </div>
                    <div class="mb-4">
                        <label for="logo_klub" class="form-label">Logo Klub</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-image"></i></span>
                            <input type="file" class="form-control @error('logo_klub') is-invalid @enderror" id="logo_klub" name="logo_klub" accept="image/*" onchange="previewImage(event)">
                        </div>
                        @error('logo_klub')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="nama" class="form-label">Nama Klub</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $klub->nama) }}" required placeholder="Contoh: Persija Jakarta">
                        @error('nama')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
                        <input type="text" class="form-control @error('tahun_berdiri') is-invalid @enderror" id="tahun_berdiri" name="tahun_berdiri" value="{{ old('tahun_berdiri', $klub->tahun_berdiri) }}" placeholder="Contoh: 1928, sekitar 1900, ?">
                        @error('tahun_berdiri')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="stadion" class="form-label">Stadion</label>
                        <input type="text" class="form-control @error('stadion') is-invalid @enderror" id="stadion" name="stadion" value="{{ old('stadion', $klub->stadion) }}" placeholder="Contoh: Gelora Bung Karno">
                        @error('stadion')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="negara_id" class="form-label">Negara</label>
                        <select class="form-select @error('negara_id') is-invalid @enderror" id="negara_id" name="negara_id" required>
                            <option value="">-- Pilih Negara --</option>
                            @foreach($negara as $n)
                                <option value="{{ $n->id }}" {{ old('negara_id', $klub->negara_id) == $n->id ? 'selected' : '' }}>{{ $n->nama }}</option>
                            @endforeach
                        </select>
                        @error('negara_id')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between gap-2">
                        <a href="{{ route('klub.index') }}" class="btn btn-secondary rounded-pill px-4"><i class="bi bi-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-gradient"><i class="bi bi-save"></i> Update</button>
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