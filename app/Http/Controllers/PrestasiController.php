<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Klub;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function store(Request $request, $klub_id)
    {
        $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'kategori' => 'required|in:Liga,Cup,League Cup,Super Cup,Piala Internasional',
            'tahun' => 'nullable|string|max:30',
        ]);

        Prestasi::create([
            'klub_id' => $klub_id,
            'nama_prestasi' => $request->nama_prestasi,
            'kategori' => $request->kategori,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('klub.show', $klub_id)->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $prestasi = \App\Models\Prestasi::findOrFail($id);
        $klubId = $prestasi->klub_id;
        $prestasi->delete();
        return redirect()->route('klub.show', $klubId)->with('success', 'Prestasi berhasil dihapus!');
    }
} 