<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemesananObat extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded = ['id'];

    public function pemesananobatdetails()
    {
        return $this->hasMany(PemesananObatDetail::class);
    }
}
