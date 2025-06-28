<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prestasi;
use App\Models\Klub;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $klubs = Klub::all();

        foreach ($klubs as $klub) {
            // Prestasi Liga
            Prestasi::create([
                'klub_id' => $klub->id,
                'nama_prestasi' => 'Juara Liga 1',
                'kategori' => 'Liga',
                'tahun' => '2023'
            ]);

            Prestasi::create([
                'klub_id' => $klub->id,
                'nama_prestasi' => 'Runner-up Liga 1',
                'kategori' => 'Liga',
                'tahun' => '2022'
            ]);

            // Prestasi Cup
            Prestasi::create([
                'klub_id' => $klub->id,
                'nama_prestasi' => 'Juara Piala Indonesia',
                'kategori' => 'Cup',
                'tahun' => '2023'
            ]);

            // Prestasi League Cup
            Prestasi::create([
                'klub_id' => $klub->id,
                'nama_prestasi' => 'Juara Community Shield',
                'kategori' => 'League Cup',
                'tahun' => '2022'
            ]);

            // Prestasi Super Cup
            Prestasi::create([
                'klub_id' => $klub->id,
                'nama_prestasi' => 'Juara Super Cup',
                'kategori' => 'Super Cup',
                'tahun' => '2023'
            ]);

            // Prestasi Piala Internasional
            Prestasi::create([
                'klub_id' => $klub->id,
                'nama_prestasi' => 'Juara AFC Champions League',
                'kategori' => 'Piala Internasional',
                'tahun' => '2021'
            ]);
        }
    }
}
