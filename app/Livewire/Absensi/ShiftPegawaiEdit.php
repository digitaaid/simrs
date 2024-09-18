<?php

namespace App\Livewire\Absensi;

use App\Models\ActivityLog;
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
    public $tanggal, $nama;
    public $shift, $id, $shift_id, $user_id, $tgl_awal, $tgl_akhir;
    public $formTambah = 0, $formEdit = 0;
    public function tambah()
    {
        $this->formTambah = $this->formTambah ? 0 : 1;
    }
    public function edit($id)
    {
        $shift =  ShiftPegawai::find($id);
        $this->shift = $shift;
        $this->id = $shift->id;
        $this->shift_id = $shift->shift_id;
        $this->user_id = $shift->user_id;
        $user = User::find($shift->user_id);
        $this->nama = $user->name;
        $this->tanggal = $shift->tanggal;
        $this->formEdit =  1;
    }
    public function update()
    {
        $shift =  ShiftPegawai::find($this->id);
        $jadwal = ShiftAbsensi::find($this->shift_id);
        $shift->shift_id = $this->shift_id;
        $shift->tanggal = $this->tanggal;
        $shift->nama_shift = $jadwal->nama;
        $shift->jam_masuk = $jadwal->jam_masuk;
        $shift->jam_pulang = $jadwal->jam_pulang;
        $shift->update();
        $this->formEdit =  0;
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Update/Create Jadwal Shift Kerja',
            'description' => auth()->user()->name . ' telah menyimpan jadwal ' . $shift->user?->name . ' shift kerja ' . $shift->nama,
        ]);
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
            $jadwal = ShiftPegawai::updateOrCreate(
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
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Create Jadwal Shift Kerja',
            'description' => auth()->user()->name . ' telah menyimpan jadwal shift kerja ' . $jadwal->user?->name,
        ]);
        $this->formTambah = 0;
    }
    public function hapus($id)
    {
        $shift =  ShiftPegawai::find($id);
        if (!$shift->absensi_masuk) {
            $shift->delete();
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'activity' => 'Delete Absensi',
                'description' => auth()->user()->name . ' telah menghapus absensi ' . $shift->user?->name . ' tanggal ' . $shift->tanggal,
            ]);
            flash('Jadwal shift kerja berhasil dihapus', 'success');
        } else {
            flash('Tidak bisa dihapus karena telah absesni', 'danger');
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
        $shift->status_absen = "Masuk";
        $shift->update();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Reset Absensi',
            'description' => auth()->user()->name . ' telah mereset absensi ' . $shift->user?->name . ' tanggal ' . $shift->tanggal,
        ]);
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
        $shift->status_absen = null;
        $shift->update();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Reset Absensi',
            'description' => auth()->user()->name . ' telah mereset absensi ' . $shift->user?->name . ' tanggal ' . $shift->tanggal,
        ]);
        Alert::success('Success', 'Absensi Masuk Berhasil Direset');
        $url = route('shift.pegawai.edit') . "?kode=" . $shift->user_id;
        return redirect()->to($url);
    }
    public function mount(Request $request)
    {
        $this->user = User::with(['shift_pegawai'])->find($request->kode);
        $this->shifts = ShiftAbsensi::get();
    }
    public function render()
    {
        return view('livewire.absensi.shift-pegawai-edit')->title('Shift Kerja Pegawai');
    }
}
