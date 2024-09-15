<?php

namespace App\Livewire\Absensi;

use App\Models\ShiftAbsensi as ModelsShiftAbsensi;
use Livewire\Component;

class ShiftAbsensi extends Component
{
    public $form = 0;
    public $shifts, $id, $nama, $jam_masuk, $jam_pulang;
    public function tambah()
    {
        $this->form = $this->form ? 0 : 1;
    }
    public function store()
    {
        $shift = new ModelsShiftAbsensi();
        $shift->nama = $this->nama;
        $shift->jam_masuk = $this->jam_masuk;
        $shift->jam_pulang = $this->jam_pulang;
        $shift->save();
        $this->form =  0;
    }

    public function render()
    {
        $this->shifts = ModelsShiftAbsensi::get();
        return view('livewire.absensi.shift-absensi')->title('Shift Absensi');
    }
}
