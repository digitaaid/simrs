<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function antrians()
    {
        return $this->hasMany(Antrian::class, 'norm', 'norm');
    }
    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class, 'norm', 'norm');
    }
}
