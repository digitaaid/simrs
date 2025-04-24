<?php

namespace App\Livewire\Igd;

use App\Models\Kunjungan;
use Livewire\Component;

class ModalIdentitasPasien extends Component
{
    public $kunjungan;
    public function mount($kunjungan)
    {
        $this->kunjungan = $kunjungan;
    }
    public function render()
    {
        return view('livewire.igd.modal-identitas-pasien');
    }
}
