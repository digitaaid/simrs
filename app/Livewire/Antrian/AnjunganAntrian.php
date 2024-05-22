<?php

namespace App\Livewire\Antrian;

use App\Models\JadwalDokter;
use Livewire\Component;

class AnjunganAntrian extends Component
{
    public $kodebooking;
    public $jenispasien;
    public $jadwals;

    public function test()
    {
        dd('test');
    }
    public function reload()
    {
        dd('test');
    }
    public function checkin()
    {
        dd('test');
    }

    public function render()
    {
        $this->jadwals = JadwalDokter::where('hari', now()->dayOfWeek)->get();
        return view('livewire.antrian.anjungan-antrian')->layout('components.layouts.layout_anjungan');
    }
}
