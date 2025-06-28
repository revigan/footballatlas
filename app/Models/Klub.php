<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klub extends Model
{
    use HasFactory;
    protected $table = 'klub';
    protected $fillable = [
        'nama', 'tahun_berdiri', 'stadion', 'negara_id', 'logo_klub'
    ];

    public function negara()
    {
        return $this->belongsTo(Negara::class, 'negara_id');
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'klub_id');
    }
} 