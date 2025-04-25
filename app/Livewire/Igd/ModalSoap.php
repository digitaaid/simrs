<?php

namespace App\Livewire\Igd;

use Livewire\Component;

class ModalSoap extends Component
{
    public $kunjungan;
    public function mount($kunjungan)
    {
        $this->kunjungan = $kunjungan;
    }
    public function render()
    {
        return view('livewire.igd.modal-soap');
    }
}
