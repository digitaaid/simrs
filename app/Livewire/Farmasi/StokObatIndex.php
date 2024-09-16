<?php

namespace App\Livewire\Farmasi;

use App\Models\Obat;
use App\Models\ResepFarmasiDetail;
use Illuminate\Http\Request;
use Livewire\Component;

class StokObatIndex extends Component
{
    public $obat, $resepfarmasidetails;
    public function mount(Request $request)
    {
        $this->obat = Obat::find($request->kode);
        $this->resepfarmasidetails = ResepFarmasiDetail::with(['kunjungan', 'antrian'])
            ->where('obat_id', $this->obat->id)
            ->get();
    }
    public function render()
    {
        return view('livewire.farmasi.stok-obat-index')->title('Stok Obat ' . $this->obat->nama);
    }
}
