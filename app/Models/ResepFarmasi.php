<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepFarmasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function antrian()
    {
        return $this->belongsTo(Antrian::class, 'kodebooking', 'kode');
    }
    public function resepfarmasidetails()
    {
        return $this->hasMany(ResepFarmasiDetail::class, 'resep_id', 'id');
    }
}
