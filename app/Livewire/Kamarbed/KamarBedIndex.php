<?php

namespace App\Livewire\Kamarbed;

use Livewire\Component;

class KamarBedIndex extends Component
{
    public $kamars;
    public function render()
    {
        return view('livewire.kamarbed.kamar-bed-index')->title('Kamar & Bed Rawat Inap');
    }
}
