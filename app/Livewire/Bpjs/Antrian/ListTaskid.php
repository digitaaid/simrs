<?php

namespace App\Livewire\Bpjs\Antrian;

use Livewire\Component;

class ListTaskid extends Component
{
    public $kodebooking;
    public function cari()
    {
        dd($this->kodebooking);
    }
    public function render()
    {
        return view('livewire.bpjs.antrian.list-taskid')->title('List Taskid');
    }
}
