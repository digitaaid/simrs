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
    public function layanans()
    {
        return $this->hasMany(Layanan::class);
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
