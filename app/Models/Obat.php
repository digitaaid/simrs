<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['real_stok'];
    public function reseps()
    {
        return $this->hasMany(ResepFarmasiDetail::class, 'obat_id', 'id');
    }
    public function stoks()
    {
        return $this->hasMany(StokObat::class, 'obat_id', 'id');
    }
    public function getRealStokAttribute()
    {
        $obatmasuk = 0;
        $resepkeluar = 0;
        if ($this->reseps) {
            $resepkeluar = $this->reseps->sum('jumlah');
        }
        if ($this->stoks) {
            $obatmasuk = $this->stoks->sum('jumlah_satuan');
        }
        $realstok = $obatmasuk - $resepkeluar;
        return $realstok; //or however you want to manipulate it
    }
}
