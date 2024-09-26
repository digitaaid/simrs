<?php

namespace App\Livewire\Absensi;

use App\Models\ActivityLog;
use App\Models\ShiftAbsensi as ModelsShiftAbsensi;
use Livewire\Component;

class ShiftAbsensi extends Component
{
    public $form = 0;
    public $shifts, $shift, $id, $nama, $jam_masuk, $jam_pulang;
    public function tambah()
    {
        $this->form = $this->form ? 0 : 1;
        $this->reset(['shift', 'id', 'nama', 'jam_masuk', 'jam_pulang']);
    }
    public function store()
    {
        if ($this->id) {
            $shift = ModelsShiftAbsensi::find($this->id);
        } else {
            $shift = new ModelsShiftAbsensi();
        }
        $shift->nama = $this->nama;
        $shift->jam_masuk = $this->jam_masuk;
        $shift->jam_pulang = $this->jam_pulang;
        $shift->save();
        $this->form =  0;
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Update/Create Jadwal Shift Kerja',
            'description' => auth()->user()->name . ' telah menyimpan jadwal shift kerja ' . $shift->nama,
        ]);
        flash('Jadwal Shift Kerja ' . $shift->nama . ' berhasil disimpan.', 'success');
    }
    public function edit(ModelsShiftAbsensi $shift)
    {
        $this->shift = $shift;
        $this->id = $shift->id;
        $this->nama = $shift->nama;
        $this->jam_masuk = $shift->jam_masuk;
        $this->jam_pulang = $shift->jam_pulang;
        $this->form =  1;
    }
    public function hapus(ModelsShiftAbsensi $shift)
    {
        $shift->delete();
        flash('Jadwal Shift Kerja berhasil dihapus.', 'success');
    }
    public function render()
    {
        $this->shifts = ModelsShiftAbsensi::get();
        return view('livewire.absensi.shift-absensi')->title('Jadwal Shift Kerja');
    }
}
