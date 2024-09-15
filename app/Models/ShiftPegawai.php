<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftPegawai extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function shift_absensi()
    {
        return $this->hasOne(ShiftAbsensi::class);
    }
}
