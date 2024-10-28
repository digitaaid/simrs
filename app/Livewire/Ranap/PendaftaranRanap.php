<?php

namespace App\Livewire\Ranap;

use App\Models\Bed;
use App\Models\Kunjungan;
use Livewire\Component;

class PendaftaranRanap extends Component
{
    public $tanggal, $beds, $bedkosong;
    public $kunjungans = [];
    public $search = '';
    public function caritanggal() {}
    public function render()
    {
        $this->tanggal = $this->tanggal ?? now()->format('Y-m-d');
        $search = '%' . $this->search . '%';
        $query = Kunjungan::where('jeniskunjungan', 6);
        if ($this->tanggal) {
            $query->whereDate('tgl_masuk', $this->tanggal);
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
    public function mount()
    {
        $this->beds = Bed::get();
        $this->bedkosong =  $this->beds->filter(function ($bed) {
            return !Kunjungan::where('bed_id', $bed->id)->where('status', 1)->exists();
        })->count();
    }
}
