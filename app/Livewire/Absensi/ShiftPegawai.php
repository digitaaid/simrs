<?php

namespace App\Livewire\Absensi;

use App\Models\ShiftAbsensi;
use App\Models\User;
use Livewire\Component;

class ShiftPegawai extends Component
{
    public $users, $shifts;
    public function mount(){
        $this->users = User::all();
        $this->shifts = ShiftAbsensi::all();
    }

    public function render()
    {
        return view('livewire.absensi.shift-pegawai')->title('Shift Kerja Pegawai');
    }
}
