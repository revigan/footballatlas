<?php

namespace App\Http\Controllers;

use App\Models\Klub;
use App\Models\Negara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KlubController extends Controller
{
    public function index(Request $request)
    {
        $query = Klub::with('negara');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('stadion', 'LIKE', "%{$search}%")
                  ->orWhere('tahun_berdiri', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter by country
        if ($request->filled('negara_id')) {
            $query->where('negara_id', $request->get('negara_id'));
        }
        
        $klub = $query->latest()->paginate(10);
        $negaraList = Negara::all();
        
        return view('klub.index', compact('klub', 'negaraList'));
    }

    public function create()
    {
        $negara = Negara::all();
        return view('klub.create', compact('negara'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun_berdiri' => 'nullable|string|max:30',
            'stadion' => 'nullable|string|max:255',
            'negara_id' => 'required|exists:negara,id',
            'logo_klub' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('logo_klub')) {
            $validated['logo_klub'] = $request->file('logo_klub')->store('klub', 'public');
        }

        Klub::create($validated);
        return redirect()->route('klub.index')->with('success', 'Klub berhasil ditambahkan!');
    }

    public function show(Klub $klub)
    {
        $klub->load('negara');
        return view('klub.show', compact('klub'));
    }

    public function edit(Klub $klub)
    {
        $negara = Negara::all();
        return view('klub.edit', compact('klub', 'negara'));
    }

    public function update(Request $request, Klub $klub)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun_berdiri' => 'nullable|string|max:30',
            'stadion' => 'nullable|string|max:255',
            'negara_id' => 'required|exists:negara,id',
            'logo_klub' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('logo_klub')) {
            if ($klub->logo_klub) {
                Storage::disk('public')->delete($klub->logo_klub);
            }
            $validated['logo_klub'] = $request->file('logo_klub')->store('klub', 'public');
        }

        $klub->update($validated);
        return redirect()->route('klub.index')->with('success', 'Klub berhasil diperbarui!');
    }

    public function destroy(Klub $klub)
    {
        if ($klub->logo_klub) {
            Storage::disk('public')->delete($klub->logo_klub);
        }
        $klub->delete();
        return redirect()->route('klub.index')->with('success', 'Klub berhasil dihapus!');
    }

    public function prestasi(Request $request, Klub $klub)
    {
        $kategori = $request->query('kategori');
        $query = $klub->prestasi();
        if ($kategori) {
            $query->where('kategori', $kategori);
        }
        $prestasi = $query->orderByDesc('tahun')->get();
        return view('klub.prestasi', compact('klub', 'prestasi', 'kategori'));
    }
} 