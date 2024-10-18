<?php

namespace App\Livewire\Igd;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Livewire\Component;

class PendaftaranIgdProses extends Component
{
    public $kunjungan;
    protected $listeners = ['refreshPage' => '$refresh'];
    public function mount(Request $request)
    {
        $this->kunjungan = Kunjungan::where('kode', $request->kode)->first();
    }
    public function render()
    {
        return view('livewire.igd.pendaftaran-igd-proses')->title('Pendaftaran IGD');
    }
}
