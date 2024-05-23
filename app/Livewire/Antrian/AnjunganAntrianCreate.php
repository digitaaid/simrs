<?php

namespace App\Livewire\Antrian;

use App\Models\Antrian;
use App\Models\JadwalDokter;
use Carbon\Carbon;
use Livewire\Component;

class AnjunganAntrianCreate extends Component
{
    public $jenispasien;
    public $tanggalperiksa;
    public $jadwals;
    public $hari;


    public function ambilantrian($jadwal)
    {
        $jadwal = JadwalDokter::find($jadwal);
        $antrian = new Antrian();
        $antrian->jadwal_id = $jadwal->id;
        $antrian->jenispasien = $this->jenispasien;
        $antrian->tanggalperiksa = $this->tanggalperiksa;
        $antrian->nomorkartu = '';
        $antrian->nik = '';
        $antrian->norm = '';
        $antrian->nohp = '';
        $antrian->nama = '';
        $antrian->jeniskunjungan = '';
        $antrian->pasienbaru = 0;
        $antrian->taskid = 1;
        $antrian->taskid1 = now();
        $antrian->method = 'Offline';
        $antrian->kodepoli = $jadwal->kodepoli;
        $antrian->namapoli = $jadwal->namapoli;
        $antrian->kodedokter = $jadwal->kodedokter;
        $antrian->namadokter = $jadwal->namadokter;
        $antrian->jampraktek = $jadwal->jampraktek;
        $antiranhari = Antrian::where('tanggalperiksa', $this->tanggalperiksa)->count();
        $antrian->kodebooking = strtoupper(uniqid());
        $antrian->nomorantrean = 'A' . $antiranhari + 1;
        $antrian->angkaantrean = $antiranhari + 1;
        $antrian->save();
        return redirect()->route('anjunganantrian.print', $antrian->kodebooking);
    }
    public function mount($jenispasien, $tanggalperiksa)
    {
        $this->tanggalperiksa = $tanggalperiksa;
        $this->jenispasien = $jenispasien;
        $this->hari = Carbon::parse($tanggalperiksa)->dayOfWeek;
    }
    public function render()
    {
        $this->jadwals = JadwalDokter::where('hari', $this->hari)->get();
        return view('livewire.antrian.anjungan-antrian-create')->layout('components.layouts.layout_anjungan');
    }
}
