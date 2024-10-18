<?php

namespace App\Livewire\Antrian;

use Livewire\Component;

class AnjunganAntrianUmum extends Component
{
    public $pasienbaru;
    protected $queryString = ['pasienbaru'];
    public function mount() {}
    public function render()
    {
        return view('livewire.antrian.anjungan-antrian-umum')->layout('components.layouts.layout_anjungan');
    }
}
