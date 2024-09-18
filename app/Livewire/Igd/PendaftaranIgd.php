<?php

namespace App\Livewire\Igd;

use App\Models\Kunjungan;
use Livewire\Component;

class PendaftaranIgd extends Component
{
    public $tanggal;
    public $kunjungans = [];
    public $search = '';
    public function caritanggal()
    {
    }
    public function render()
    {
        if ($this->tanggal == null) {
            $this->tanggal = now()->format('Y-m-d');
        }
        if ($this->tanggal) {
            $search = '%' . $this->search . '%';
            $this->kunjungans = Kunjungan::where('jeniskunjungan', 5)->get();
        }
        if ($this->search && $this->tanggal == null) {
            $search = '%' . $this->search . '%';
            $this->kunjungans = Kunjungan::where('jeniskunjungan', 5)->get();
        }
        return view('livewire.igd.pendaftaran-igd')->title('Pasien IGD');
    }
}
