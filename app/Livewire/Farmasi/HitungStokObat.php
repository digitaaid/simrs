<?php

namespace App\Livewire\Farmasi;

use App\Models\Obat;
use Livewire\Component;

class HitungStokObat extends Component
{
    public $stokminus, $stokterbatas, $obataktif;

    public function mount()
    {
        $this->stokminus = Obat::all()->filter(function ($obat) {
            return $obat->real_stok < 0;
        })->count();
        $this->stokterbatas = Obat::all()->filter(function ($obat) {
            $stokmin = $obat->stok_minimum ?? 0;
            return $obat->real_stok < $stokmin;
        })->count();
        $this->obataktif = Obat::where('status', 1)->count();
    }
    public function render()
    {
        return view('livewire.farmasi.hitung-stok-obat');
    }
}
