<?php

namespace App\Livewire\Igd;

use App\Models\Antrian;
use App\Models\Kunjungan;
use Livewire\Component;

class PendaftaranIgd extends Component
{
    public $tanggalperiksa;
    public $kunjungans = [];
    public $search = '';
    public function render()
    {
        if ($this->tanggalperiksa == null) {
            $this->tanggalperiksa = now()->format('Y-m-d');
        }
        if ($this->tanggalperiksa) {
            $search = '%' . $this->search . '%';
            $this->kunjungans = Kunjungan::where('jeniskunjungan',5)->get();
        }
        if ($this->search && $this->tanggalperiksa == null) {
            $search = '%' . $this->search . '%';
            $this->kunjungans = Kunjungan::where('jeniskunjungan',5)->get();
        }
        return view('livewire.igd.pendaftaran-igd')->title('Pendaftaran IGD');
    }
}
