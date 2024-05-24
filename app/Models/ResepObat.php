<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function antrian()
    {
        return $this->belongsTo(Antrian::class, 'kodebooking', 'kode');
    }
    public function resepobatdetails()
    {
        return $this->hasMany(ResepObatDetail::class, 'resep_id', 'id');
    }
}
