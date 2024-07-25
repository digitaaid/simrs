<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function antrian()
    {
        return $this->belongsTo(Antrian::class,  'kode', 'kodebooking');
    }
    public function dokters()
    {
        return $this->hasOne(Dokter::class, 'kode', 'dokter');
    }
    public function units()
    {
        return $this->hasOne(Unit::class,  'kode', 'unit');
    }
    public function asesmenrajal()
    {
        return $this->hasOne(AsesmenRajal::class);
    }
    public function resepobat()
    {
        return $this->hasOne(ResepObat::class);
    }
    public function resepobatdetails()
    {
        return $this->hasMany(ResepObatDetail::class);
    }
    public function resepfarmasi()
    {
        return $this->hasOne(ResepFarmasi::class);
    }
    public function resepfarmasidetails()
    {
        return $this->hasMany(ResepFarmasiDetail::class);
    }

}
