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
        return $this->hasOne(Kunjungan::class);
    }
}
