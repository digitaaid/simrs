<?php

namespace App\Livewire\Dokter;

use Livewire\Component;

class ModalDokterRajal extends Component
{
    public function modalPemeriksaanDokter()
    {
        $this->dispatch('modalPemeriksaanDokter');
    }
    public function render()
    {
        return view('livewire.dokter.modal-dokter-rajal');
    }
}
