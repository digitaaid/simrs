<?php

namespace App\Livewire\Dashboard;

use App\Models\ShiftPegawai;
use Carbon\Carbon;
use Livewire\Component;

class JadwalAbsensi extends Component
{
    public $tanggals, $user, $absensi;
    public function mount()
    {
        $this->user = auth()->user();
        $bulan = now()->month;
        $tahun = now()->year;
        $jumlahHari = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
        $tanggalBulanIni = [];
        for ($i = 1; $i <= $jumlahHari; $i++) {
            $tanggal = Carbon::createFromDate($tahun, $bulan, $i)->format('Y-m-d');
            $tanggalBulanIni[] = $tanggal;
        }
        $this->tanggals = $tanggalBulanIni;

        $this->absensi = ShiftPegawai::where('user_id', $this->user->id)
            ->where('tanggal', now()->format('Y-m-d'))->first();
    }
    public function render()
    {
        return view('livewire.dashboard.jadwal-absensi');
    }
}
