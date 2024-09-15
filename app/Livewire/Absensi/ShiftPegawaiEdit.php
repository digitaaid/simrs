<?php

namespace App\Livewire\Absensi;

use App\Models\ShiftAbsensi;
use App\Models\ShiftPegawai;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class ShiftPegawaiEdit extends Component
{
    public $kode, $user, $shifts;
    public $shift_id, $user_id, $tgl_awal, $tgl_akhir;
    public function mount(Request $request)
    {
        $this->user = User::find($request->kode);
        $this->shifts = ShiftAbsensi::get();
    }

    public function store()
    {
        $this->user_id = $this->user->id;
        $shift = ShiftAbsensi::find($this->shift_id);
        $tglawal = Carbon::parse($this->tgl_awal);
        $tglakhir = Carbon::parse($this->tgl_akhir);
        $jadwals = [];
        while ($tglawal->lte($tglakhir)) {
            $jadwals[] = $tglawal->toDateString();
            $tglawal->addDay();
        }
        foreach ($jadwals as $tanggal) {
            ShiftPegawai::updateOrCreate(
                [
                    'tanggal' => $tanggal,
                    'user_id' => $this->user_id,
                    'shift_id' => $this->shift_id,
                ],
                [
                    'nama_shift' => $shift->nama,
                    'jam_masuk' => $shift->jam_masuk,
                    'jam_pulang' => $shift->jam_pulang,
                ]
            );
        }
    }
    public function render()
    {
        return view('livewire.absensi.shift-pegawai-edit')->title('Shift Kerja Pegawai');
    }
}
