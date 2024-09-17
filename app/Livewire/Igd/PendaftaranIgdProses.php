<?php

namespace App\Livewire\Igd;

use Livewire\Component;

class PendaftaranIgdProses extends Component
{
    public $kunjungan;
    public function render()
    {
        return view('livewire.igd.pendaftaran-igd-proses')->title('Pendaftaran IGD');
    }
}
