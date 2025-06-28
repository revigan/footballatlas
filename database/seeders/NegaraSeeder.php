<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Negara;

class NegaraSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Inggris',
                'kode_negara' => 'GBR',
                'konfederasi' => 'UEFA',
                'foto_negara' => null,
            ],
            [
                'nama' => 'Brasil',
                'kode_negara' => 'BRA',
                'konfederasi' => 'CONMEBOL',
                'foto_negara' => null,
            ],
            [
                'nama' => 'Indonesia',
                'kode_negara' => 'IDN',
                'konfederasi' => 'AFC',
                'foto_negara' => null,
            ],
        ];

        foreach ($data as $negara) {
            Negara::updateOrCreate([
                'kode_negara' => $negara['kode_negara']
            ], $negara);
        }
    }
} 