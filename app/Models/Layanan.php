<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function pic()
    {
        return $this->hasOne(User::class,  'id', 'user');
    }
    public function jaminans()
    {
        return $this->hasOne(Jaminan::class, 'kode', 'jaminan');
    }
}
