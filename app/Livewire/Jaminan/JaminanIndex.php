<?php

namespace App\Livewire\Jaminan;

use App\Models\Jaminan;
use Livewire\Component;

class JaminanIndex extends Component
{
    public $jaminans;
    public function mount()
    {
        $this->jaminans = Jaminan::get();
    }
    public function render()
    {
        return view('livewire.jaminan.jaminan-index')->title('Jaminan');
    }
}
