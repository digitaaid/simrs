<?php

namespace App\Livewire\Dokter;

use App\Models\Antrian;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Livewire\Component;
use Livewire\WithPagination;

class ModalCppt extends Component
{
    use WithPagination;
    public  $pasien;
    public function modalCppt()
    {
        $this->dispatch('modalCppt');
    }
    public function mount(Antrian $antrian)
    {
        $this->pasien = $antrian->pasien;
    }
    public function render()
    {
        $kunjungans  = [];
        if ($this->pasien) {
            $kunjungans = Kunjungan::where('norm', $this->pasien->norm)
                ->where('status', 1)
                ->with('asesmenrajal', 'antrian', 'resepobat', 'resepobatdetails', 'units', 'dokters')
                ->orderBy('tgl_masuk', 'desc')
                ->paginate(2);
        }
        return view('livewire.dokter.modal-cppt', compact('kunjungans'));
    }
}
