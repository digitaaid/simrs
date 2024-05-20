<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function dokter()
    {
        return $this->hasOne(Dokter::class, 'kode', 'kodedokter');
    }
    public function unit()
    {
        return $this->hasOne(Unit::class, 'kode', 'kodepoli');
    }

}
