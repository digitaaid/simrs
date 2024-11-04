<?php

namespace App\Livewire\Pendaftaran;

use App\Models\Antrian;
use App\Models\Kunjungan;
use Livewire\Component;

class MonitoringRajal extends Component
{
    public $tgl_awal, $tgl_akhir, $kunjungans = [], $antrians = [];
    public function render()
    {
        if ($this->tgl_awal && $this->tgl_akhir) {
            $this->antrians = Antrian::whereBetween('tanggalperiksa', [$this->tgl_awal, $this->tgl_akhir])
                ->orderBy('tanggalperiksa', 'asc')
                ->get();
        }
        return view('livewire.pendaftaran.monitoring-rajal')->title('Monitoring Rawat Jalan');
    }
    public function mount()
    {
        $this->tgl_awal = now()->startOfMonth()->format('Y-m-d');
        $this->tgl_akhir = now()->format('Y-m-d');
    }
}
