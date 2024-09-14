<?php

namespace App\Livewire\Absensi;

use Livewire\Component;

class LokasiSaya extends Component
{
    public $lat, $long;
    public function render()
    {
        $this->lat = -6.9236;
        $this->long = 107.7719;
        return view('livewire.absensi.lokasi-saya')->title('Lokasi Saya');
    }
}
