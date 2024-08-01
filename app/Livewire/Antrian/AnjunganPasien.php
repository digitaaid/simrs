<?php

namespace App\Livewire\Antrian;

use Livewire\Component;

class AnjunganPasien extends Component
{
    public $pasienbaru;
    protected $queryString = ['pasienbaru'];
    public function mount()
    {
    }
    public function render()
    {
        return view('livewire.antrian.anjungan-pasien')->layout('components.layouts.layout_anjungan');
    }
}
