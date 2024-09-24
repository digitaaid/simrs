<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepFarmasiDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }
    public function antrian()
    {
        return $this->belongsTo(Antrian::class);
    }
    public function resep()
    {
        return $this->belongsTo(ResepFarmasi::class);
    }
}
