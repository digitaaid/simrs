<?php

namespace App\Livewire\Dokter;

use Livewire\Component;

class ModalAsesmenRajal extends Component
{
    public function modalAsesmenRajal()
    {
        $this->dispatch('modalAsesmenRajal');
    }
    public function render()
    {
        return view('livewire.dokter.modal-asesmen-rajal');
    }
}
