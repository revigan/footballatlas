<?php

namespace App\Http\Controllers;

use App\Models\Negara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NegaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Negara::query();
        $search = $request->input('search');
        $filter = $request->input('konfederasi');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('kode_negara', 'like', "%$search%")
                  ->orWhere('konfederasi', 'like', "%$search%") ;
            });
        }
        if ($filter) {
            $query->where('konfederasi', $filter);
        }
        $negara = $query->get();
        $konfederasiList = ['AFC','CAF','CONCACAF','CONMEBOL','OFC','UEFA'];
        return view('negara.index', compact('negara', 'search', 'filter', 'konfederasiList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('negara.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:negara,nama',
            'kode_negara' => 'required|string|max:10|unique:negara,kode_negara',
            'konfederasi' => 'required|string|max:30',
            'foto_negara' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $data = $request->only(['nama', 'kode_negara', 'konfederasi']);
        if ($request->hasFile('foto_negara')) {
            $file = $request->file('foto_negara');
            $path = $file->store('bendera', 'public');
            $data['foto_negara'] = $path;
        }

        Negara::create($data);

        return redirect()->route('negara.index')->with('success', 'Negara berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Negara $negara)
    {
        return view('negara.show', compact('negara'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Negara $negara)
    {
        return view('negara.edit', compact('negara'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Negara $negara)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:negara,nama,' . $negara->id,
            'kode_negara' => 'required|string|max:10|unique:negara,kode_negara,' . $negara->id,
            'konfederasi' => 'required|string|max:30',
            'foto_negara' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $data = $request->only(['nama', 'kode_negara', 'konfederasi']);
        if ($request->hasFile('foto_negara')) {
            // Hapus file lama jika ada
            if ($negara->foto_negara && Storage::disk('public')->exists($negara->foto_negara)) {
                Storage::disk('public')->delete($negara->foto_negara);
            }
            $file = $request->file('foto_negara');
            $path = $file->store('bendera', 'public');
            $data['foto_negara'] = $path;
        }

        $negara->update($data);

        return redirect()->route('negara.index')->with('success', 'Negara berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Negara $negara)
    {
        if ($negara->foto_negara && Storage::disk('public')->exists($negara->foto_negara)) {
            Storage::disk('public')->delete($negara->foto_negara);
        }
        $negara->delete();
        return redirect()->route('negara.index')->with('success', 'Negara berhasil dihapus.');
    }

    public function prestasi(Negara $negara)
    {
        $prestasi = $negara->prestasiNegara()->orderByDesc('tahun')->get();
        return view('negara.prestasi', compact('negara', 'prestasi'));
    }
}
