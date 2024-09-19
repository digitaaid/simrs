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
    public function pasien()
    {
        return $this->hasOne(Pasien::class, 'norm', 'norm');
    }
    public function dokters()
    {
        return $this->hasOne(Dokter::class, 'kode', 'dokter');
    }
    public function units()
    {
        return $this->hasOne(Unit::class,  'kode', 'unit');
    }
    public function beds()
    {
        return $this->hasOne(Bed::class,  'id', 'bed_id');
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
    public function pic1()
    {
        return $this->hasOne(User::class,  'id', 'user1');
    }
    public function pic2()
    {
        return $this->hasOne(User::class,  'id', 'user2');
    }
    public function pic3()
    {
        return $this->hasOne(User::class,  'id', 'user3');
    }
    public function pic4()
    {
        return $this->hasOne(User::class,  'id', 'user4');
    }
}
