<?php

namespace App\Livewire\Pegawai;

use App\Models\User;
use Livewire\Component;

class PegawaiIndex extends Component
{
    public function render()
    {
        return view('livewire.pegawai.pegawai-index')
            ->with([
                'users' => User::with('pegawai')->get(),
            ])
            ->title('Pegawai');
    }
}
