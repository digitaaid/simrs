<?php

namespace App\Livewire\Igd;

use App\Models\Kunjungan;
use Livewire\Component;

class PemeriksaanIgdProses extends Component
{
    public $kunjungan;
    protected $listeners = ['refreshPage' => '$refresh'];
    public function mount($kodebooking)
    {
        $this->kunjungan = Kunjungan::where('kode', $kodebooking)->first();
    }
    public function render()
    {
        return view('livewire.igd.pemeriksaan-igd-proses');
    }
}
