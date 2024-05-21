<?php

namespace App\Livewire\Antrian;

use App\Models\JadwalDokter;
use Carbon\Carbon;
use Livewire\Component;

class AnjunganAntrianCreate extends Component
{
    public $jenispasien;
    public $tanggalperiksa;
    public $jadwals;
    public $hari;


    public function ambilantrian($jadwal)
    {
        dd($jadwal, $this->jenispasien, $this->tanggalperiksa);
    }
    public function mount($jenispasien, $tanggalperiksa)
    {
        $this->tanggalperiksa = $tanggalperiksa;
        $this->jenispasien = $jenispasien;
        $this->hari = Carbon::parse($tanggalperiksa)->dayOfWeek;
    }
    public function render()
    {
        $this->jadwals = JadwalDokter::where('hari', $this->hari)->get();
        return view('livewire.antrian.anjungan-antrian-create')->layout('components.layouts.layout_anjungan');
    }
}
