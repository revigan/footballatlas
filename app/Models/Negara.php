<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;

    protected $table = 'negara';

    protected $fillable = [
        'nama',
        'kode_negara',
        'konfederasi',
        'foto_negara',
    ];

    public function klub()
    {
        return $this->hasMany(\App\Models\Klub::class, 'negara_id');
    }

    public function prestasiNegara()
    {
        return $this->hasMany(PrestasiNegara::class);
    }
} 