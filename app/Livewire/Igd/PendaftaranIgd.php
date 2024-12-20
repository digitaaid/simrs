<?php

namespace App\Livewire\Igd;

use App\Models\Kunjungan;
use Livewire\Component;

class PendaftaranIgd extends Component
{
    public $tanggal;
    public $kunjungans = [];
    public $search = '';
    public function caritanggal() {}
    public function render()
    {
        $this->tanggal = $this->tanggal ?? now()->format('Y-m-d');
        $search = '%' . $this->search . '%';
        $query = Kunjungan::where('jeniskunjungan', 5);
        if ($this->tanggal) {
            $query->whereDate('tgl_masuk', $this->tanggal);
        }
        if ($this->search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', $search)
                    ->orWhere('norm', 'like', $search);
            });
        } else {
            $query->orWhere('status', 1)->where('jeniskunjungan', 5);
        }
        $this->kunjungans = $query->get();
        return view('livewire.igd.pendaftaran-igd')->title('Pasien IGD');
    }
}
