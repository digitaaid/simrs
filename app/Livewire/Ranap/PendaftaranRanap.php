<?php

namespace App\Livewire\Ranap;

use App\Models\Kunjungan;
use Livewire\Component;

class PendaftaranRanap extends Component
{
    public $tanggal;
    public $kunjungans = [];
    public $search = '';
    public function caritanggal() {}
    public function render()
    {
        if ($this->tanggal == null) {
            $this->tanggal = now()->format('Y-m-d');
        }
        if ($this->tanggal) {
            $search = '%' . $this->search . '%';
            $this->kunjungans = Kunjungan::where('jeniskunjungan', 6)->get();
        }
        if ($this->search && $this->tanggal == null) {
            $search = '%' . $this->search . '%';
            $this->kunjungans = Kunjungan::where('jeniskunjungan', 6)->get();
        }
        return view('livewire.ranap.pendaftaran-ranap')->title('Pendaftaran Rawat Inap');
    }
}
