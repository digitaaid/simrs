<?php

namespace App\Livewire\Perawat;

use Livewire\Component;

class ModalPerawatRajal extends Component
{
    public function modalPemeriksaanPerawat()
    {
        $this->dispatch('modalPemeriksaanPerawat');
    }
    public function render()
    {
        return view('livewire.perawat.modal-perawat-rajal');
    }
}
