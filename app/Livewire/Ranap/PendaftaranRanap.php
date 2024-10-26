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
