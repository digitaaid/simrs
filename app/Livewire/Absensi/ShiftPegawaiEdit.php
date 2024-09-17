<?php

namespace App\Livewire\Absensi;

use App\Models\ShiftAbsensi;
use App\Models\ShiftPegawai;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

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
    public function resetpulang($id)
    {
        $shift = ShiftPegawai::find($id);
        $shift->absensi_pulang = null;
        $shift->pulang_cepat = null;
        $shift->lat_pulang = null;
        $shift->long_pulang = null;
        $shift->jarak_pulang = null;
        $shift->foto_absensi_pulang = null;
        $shift->status_absen = null;
        $shift->update();
        Alert::success('Success', 'Absensi Pulang Berhasil Direset');
        $url = route('shift.pegawai.edit') . "?kode=" . $shift->user_id;
        return redirect()->to($url);
    }
    public function resetmasuk($id)
    {
        $shift = ShiftPegawai::find($id);
        $shift->absensi_masuk = null;
        $shift->telat = null;
        $shift->lat_masuk = null;
        $shift->long_masuk = null;
        $shift->jarak_masuk = null;
        $shift->foto_absensi_masuk = null;
        $shift->status_absen = "Masuk";
        $shift->update();
        Alert::success('Success', 'Absensi Masuk Berhasil Direset');
        $url = route('shift.pegawai.edit') . "?kode=" . $shift->user_id;
        return redirect()->to($url);
    }
    public function render()
    {
        return view('livewire.absensi.shift-pegawai-edit')->title('Shift Kerja Pegawai');
    }
}
