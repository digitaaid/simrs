<?php

namespace App\Livewire\Absensi;

use App\Models\ActivityLog;
use App\Models\ShiftAbsensi;
use App\Models\ShiftPegawai as ModelsShiftPegawai;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class ShiftPegawai extends Component
{
    public $search, $formTambah = 0, $formEdit = 0;
    public $bulan;
    public $users, $shifts, $tanggals, $absensis;
    public $shift, $id, $nama, $tanggal, $shift_id, $user_id, $tgl_awal, $tgl_akhir;
    public function tambah($tanggal, User $user)
    {
        $this->user_id = $user->id;
        $this->nama = $user->name;
        $this->tanggal = $tanggal;
        $this->reset('shift_id');
        $this->formTambah =  1;
        $this->formEdit =  0;
    }
    public function store()
    {
        $shift = ShiftAbsensi::find($this->shift_id);
        $jadwal = ModelsShiftPegawai::updateOrCreate(
            [
                'tanggal' => $this->tanggal,
                'user_id' => $this->user_id,
                'shift_id' => $this->shift_id,
            ],
            [
                'nama_shift' => $shift->nama,
                'jam_masuk' => $shift->jam_masuk,
                'jam_pulang' => $shift->jam_pulang,
            ]
        );
        $this->formTambah =  0;
        $this->formEdit =  0;
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Create Jadwal Absensi Pegawai',
            'description' => auth()->user()->name . ' telah menyimpan jadwal ' . $jadwal->user?->name . ' shift kerja ' . $jadwal->nama,
        ]);
    }
    public function tutuptambah()
    {
        $this->formTambah =  0;
    }
    public function tutupedit()
    {
        $this->formEdit =  0;
    }
    public function edit($id)
    {
        $shift =  ModelsShiftPegawai::find($id);
        $this->shift = $shift;
        $this->id = $shift->id;
        $this->shift_id = $shift->shift_id;
        $this->user_id = $shift->user_id;
        $user = User::find($shift->user_id);
        $this->nama = $user->name;
        $this->tanggal = $shift->tanggal;
        $this->formEdit =  1;
        $this->formTambah =  0;
    }
    public function update()
    {
        $shift =  ModelsShiftPegawai::find($this->id);
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
            'activity' => 'Update Jadwal Absensi Pegawai',
            'description' => auth()->user()->name . ' telah mengupdate jadwal ' . $shift->user?->name . ' shift kerja ' . $shift->nama,
        ]);
    }
    public function mount()
    {
        $this->shifts = ShiftAbsensi::all();
        $this->bulan = now()->format('Y-m');
    }
    public function render()
    {
        // get tanggal
        $year = Carbon::parse($this->bulan)->year;  // Mendapatkan tahun dari input
        $month = Carbon::parse($this->bulan)->month; // Mendapatkan bulan dari input
        $jumlahHari = Carbon::createFromDate($year, $month, 1)->daysInMonth; // Mendapatkan jumlah hari dalam bulan ini
        $tanggalBulanIni = [];
        for ($i = 1; $i <= $jumlahHari; $i++) {
            $tanggal = Carbon::createFromDate($year, $month, $i)->format('Y-m-d');
            $tanggalBulanIni[] = $tanggal;
        }
        $this->tanggals = $tanggalBulanIni;
        // get data
        $search = '%' . $this->search . '%';
        $this->users = User::where('name', 'like', $search)
            ->where('email_verified_at', '!=', null)
            ->orderBy('name','asc')
            ->get();
        $this->absensis = ModelsShiftPegawai::whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->get();
        return view('livewire.absensi.shift-pegawai')->title('Shift Kerja Pegawai');
    }
}
