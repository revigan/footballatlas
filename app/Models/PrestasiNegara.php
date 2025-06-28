<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiNegara extends Model
{
    use HasFactory;

    protected $table = 'prestasi_negara';

    protected $fillable = [
        'negara_id',
        'nama_prestasi',
        'tahun',
    ];

    public function negara()
    {
        return $this->belongsTo(Negara::class);
    }
}
