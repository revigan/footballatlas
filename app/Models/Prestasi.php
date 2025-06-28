<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;
    protected $table = 'prestasi';
    protected $fillable = [
        'klub_id', 'nama_prestasi', 'kategori', 'tahun'
    ];

    // Konstanta untuk kategori prestasi
    const KATEGORI_LIGA = 'Liga';
    const KATEGORI_CUP = 'Cup';
    const KATEGORI_LEAGUE_CUP = 'League Cup';
    const KATEGORI_SUPER_CUP = 'Super Cup';
    const KATEGORI_PIALA_INTERNASIONAL = 'Piala Internasional';

    public static function getKategoriList()
    {
        return [
            self::KATEGORI_LIGA => 'Liga',
            self::KATEGORI_CUP => 'Cup',
            self::KATEGORI_LEAGUE_CUP => 'League Cup',
            self::KATEGORI_SUPER_CUP => 'Super Cup',
            self::KATEGORI_PIALA_INTERNASIONAL => 'Piala Internasional'
        ];
    }

    public function klub()
    {
        return $this->belongsTo(Klub::class, 'klub_id');
    }
} 