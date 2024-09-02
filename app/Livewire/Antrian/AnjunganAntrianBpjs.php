<?php

namespace App\Livewire\Antrian;

use Livewire\Component;

class AnjunganAntrianBpjs extends Component
{
    public $pasienbaru;
    protected $queryString = ['pasienbaru'];
    public function mount() {}
    public function render()
    {
        return view('livewire.antrian.anjungan-antrian-bpjs')->layout('components.layouts.layout_anjungan');
    }
}
