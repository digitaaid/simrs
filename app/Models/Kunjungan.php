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

}
