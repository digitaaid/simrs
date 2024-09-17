<?php

namespace App\Livewire\Absensi;

use App\Models\LokasiAbsensi;
use Livewire\Component;

class LokasiSaya extends Component
{
    public $lat, $long;
    public $latitude, $longitude, $radius;
    public function render()
    {
        $lokasikantor = LokasiAbsensi::first();
        $this->latitude = $lokasikantor->latitude;
        $this->longitude = $lokasikantor->longitude;
        $this->radius = $lokasikantor->radius;
        $this->lat = -6.9236;
        $this->long = 107.7719;
        return view('livewire.absensi.lokasi-saya')->title('Lokasi Saya');
    }
}
