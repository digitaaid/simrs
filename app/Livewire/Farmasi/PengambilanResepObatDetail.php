<?php

namespace App\Livewire\Farmasi;

use App\Models\Antrian;
use App\Models\FrekuensiObat;
use App\Models\Obat;
use App\Models\WaktuObat;
use Livewire\Component;

class PengambilanResepObatDetail extends Component
{
    public $antrian;
    public $obats = [], $frekuensiObats = [], $waktuObats = [];
    public $resepObat = [
        [
            'obat' => '',
            'jumlahobat' => '',
            'frekuensiobat' => '',
            'waktuobat' => '',
            'keterangan' => '',
        ]
    ];
    public function addObat()
    {
        $this->resepObat[] = ['obat' => '', 'jumlahobat' => '', 'frekuensiobat' => '', 'waktuobat' => '', 'keterangan' => ''];
    }
    public function removeObat($index)
    {
        unset($this->resepObat[$index]);
        $this->resepObat = array_values($this->resepObat);
    }
    public function mount(Antrian $antrian)
    {
        $this->antrian = $antrian;
        if (count($this->antrian->resepobatdetails)) {
            $this->resepObat = [];
            foreach ($this->antrian->resepobatdetails as $key => $value) {
                $this->resepObat[] = ['obat' => $value->nama, 'jumlahobat' => $value->jumlah, 'frekuensiobat' => $value->frekuensi, 'waktuobat' => $value->waktu, 'keterangan' =>  $value->keterangan,];
            }
        }
        $this->obats = Obat::pluck('nama','harga_jual');
        $this->frekuensiObats = FrekuensiObat::pluck('nama');
        $this->waktuObats = WaktuObat::pluck('nama');
    }
    public function render()
    {
        return view('livewire.farmasi.pengambilan-resep-obat-detail');
    }
}
