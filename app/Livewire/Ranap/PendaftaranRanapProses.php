<?php

namespace App\Livewire\Ranap;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Livewire\Component;

class PendaftaranRanapProses extends Component
{
    public $kunjungan;
    protected $listeners = ['refreshPage' => '$refresh'];
    public function mount(Request $request)
    {
        $this->kunjungan = Kunjungan::where('kode', $request->kode)->first();
    }
    public function render()
    {
        if ($this->kunjungan) {
            $title = "Rawat Inap " . $this->kunjungan->nama;
        } else {
            $title = "Pendaftaran Pasien Rawat Inap";
        }
        return view('livewire.ranap.pendaftaran-ranap-proses')->title($title);
    }
}
