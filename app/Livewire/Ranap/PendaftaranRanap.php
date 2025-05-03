<?php

namespace App\Livewire\Ranap;

use App\Models\Bed;
use App\Models\Kunjungan;
use Livewire\Component;

class PendaftaranRanap extends Component
{
    public $tanggal, $beds;
    public $kunjungans = [];
    public $search = '';
    public function mount()
    {
        $this->beds = Bed::get();
        $this->tanggal = request('tanggal', now()->format('Y-m-d'));
    }
    public function render()
    {
        $this->tanggal = $this->tanggal ?? now()->format('Y-m-d');
        $search = '%' . $this->search . '%';
        $query = Kunjungan::where('jeniskunjungan', 6);
        if ($this->tanggal) {
            $query->where(function ($q) {
                $q->whereDate('tgl_masuk', '<=', $this->tanggal)
                  ->whereDate('tgl_pulang', '>=', $this->tanggal);
            });
        }
        if ($this->search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', $search)
                  ->orWhere('norm', 'like', $search);
            });
        } else {
            $query->orWhere('status', 1)->where('jeniskunjungan', 6);
        }
        $this->kunjungans = $query->get();
        return view('livewire.ranap.pendaftaran-ranap')->title('Pasien Rawat Inap');
    }
}
