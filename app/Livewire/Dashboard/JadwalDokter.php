<?php

namespace App\Livewire\Dashboard;

use App\Models\Antrian;
use App\Models\JadwalDokter as ModelsJadwalDokter;
use Livewire\Component;

class JadwalDokter extends Component
{
    public $jadwals, $antrians;
    public function mount()
    {
        $this->jadwals = ModelsJadwalDokter::where('hari', now()->dayOfWeek)->get();
        $this->antrians = Antrian::whereDate('tanggalperiksa', now()->format('Y-m-d'))->get();
    }
    public function render()
    {
        return view('livewire.dashboard.jadwal-dokter');
    }
}
