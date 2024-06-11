<?php

namespace App\Livewire\Dokter;

use Livewire\Component;
use App\Models\Antrian;


class ModalResumeRajal extends Component
{
    public $antrian;
    public function mount(Antrian $antrian)
    {
        $this->antrian = $antrian;
    }
    public function render()
    {
        return view('livewire.dokter.modal-resume-rajal');
    }
}
