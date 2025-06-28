<?php

namespace App\Http\Controllers;

use App\Models\PrestasiNegara;
use Illuminate\Http\Request;

class PrestasiNegaraController extends Controller
{
    public function store(Request $request, $negara_id)
    {
        $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'tahun' => 'required|string|max:4',
        ]);

        PrestasiNegara::create([
            'negara_id' => $negara_id,
            'nama_prestasi' => $request->nama_prestasi,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('negara.show', $negara_id)->with('success', 'Prestasi tim nasional berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $prestasi = \App\Models\PrestasiNegara::findOrFail($id);
        $negaraId = $prestasi->negara_id;
        $prestasi->delete();
        return redirect()->route('negara.show', $negaraId)->with('success', 'Prestasi tim nasional berhasil dihapus!');
    }
}
