<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // Tambahkan properti appends
    protected $appends = ['terisi'];
    // Accessor untuk mengecek apakah bed memiliki kunjungan aktif
    public function getTerisiAttribute()
    {
        return Kunjungan::where('bed_id', $this->id)
            ->where('status', 1)
            ->exists();
    }
}
