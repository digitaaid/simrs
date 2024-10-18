<?php

namespace App\Livewire\Ranap;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Livewire\Component;

class PendaftaranRanapProses extends Component
{
    public $kunjungan;
    public function mount(Request $request)
    {
        $this->kunjungan = Kunjungan::where('kode', $request->kode)->first();
    }
    public function render()
    {
        return view('livewire.ranap.pendaftaran-ranap-proses')->title('Pendaftaran Rawat Inap');
    }
}
