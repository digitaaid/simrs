<?php

namespace App\Livewire\Ranap;

use App\Models\Kamar;
use Livewire\Component;

class DisplayRanap extends Component
{
    public $kamars, $beds, $ranaps;
    public function render()
    {
        $this->kamars = Kamar::get();
        return view('livewire.ranap.display-ranap')
            ->layout('components.layouts.layout_anjungan');
    }

}
