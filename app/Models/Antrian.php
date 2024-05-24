<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kodebooking', 'kode');
    }
    public function dokters()
    {
        return $this->hasOne(Dokter::class, 'kode', 'kodedokter');
    }
    public function units()
    {
        return $this->hasOne(Unit::class,  'kode', 'kodepoli');
    }
    public function layanans()
    {
        return $this->hasMany(Layanan::class);
    }
    public function resepobat()
    {
        return $this->hasMany(ResepObat::class);
    }
    public function resepobatdetails()
    {
        return $this->hasMany(ResepObatDetail::class);
    }
    public function asesmenrajal()
    {
        return $this->hasOne(AsesmenRajal::class);
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
