<?php

namespace App\Livewire\Pegawai;

use App\Models\User;
use Livewire\Component;

class PegawaiIndex extends Component
{
    public function render()
    {
        return view('livewire.pegawai.pegawai-index')
            ->title('Pegawai');
    }
}
