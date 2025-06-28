<?php

namespace Database\Seeders;

use App\Models\Klub;
use App\Models\Negara;
use Illuminate\Database\Seeder;

class KlubSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Manchester United',
                'tahun_berdiri' => 1878,
                'stadion' => 'Old Trafford',
                'negara_kode' => 'ENG',
            ],
            [
                'nama' => 'Real Madrid',
                'tahun_berdiri' => 1902,
                'stadion' => 'Santiago Bernabéu',
                'negara_kode' => 'ESP',
            ],
            [
                'nama' => 'Bayern Munich',
                'tahun_berdiri' => 1900,
                'stadion' => 'Allianz Arena',
                'negara_kode' => 'DEU',
            ],
            [
                'nama' => 'Persija Jakarta',
                'tahun_berdiri' => 1928,
                'stadion' => 'Gelora Bung Karno',
                'negara_kode' => 'IDN',
            ],
            [
                'nama' => 'PSS Sleman',
                'tahun_berdiri' => 1976,
                'stadion' => 'Maguwoharjo',
                'negara_kode' => 'IDN',
            ],
            [
                'nama' => 'Klub Tanpa Tahun',
                'tahun_berdiri' => null,
                'stadion' => 'Stadion X',
                'negara_kode' => 'IDN',
            ],
        ];

        foreach ($data as $d) {
            $negara = Negara::where('kode_negara', $d['negara_kode'])->first();
            if ($negara) {
                $tahun = (is_numeric($d['tahun_berdiri']) && $d['tahun_berdiri'] >= 1800 && $d['tahun_berdiri'] <= intval(date('Y'))) ? $d['tahun_berdiri'] : null;
                Klub::updateOrCreate([
                    'nama' => $d['nama'],
                ], [
                    'tahun_berdiri' => $tahun,
                    'stadion' => $d['stadion'],
                    'negara_id' => $negara->id,
                    'logo_klub' => null,
                ]);
            }
        }
    }
} 