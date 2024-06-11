<?php

namespace App\Livewire\Antrian;

use App\Http\Controllers\VclaimController;
use App\Models\Antrian;
use App\Models\JadwalDokter;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class DaftarAntrian extends Component
{
    public $pasien, $jadwals = [], $jadwal;
    public $nohp, $nik, $tanggalperiksa, $norm, $nama, $nomorkartu, $jenispasien;
    public function daftarAntrian()
    {
        $jadwal = JadwalDokter::find($this->jadwal);
        $antrian = new Antrian();
        $antrian->jadwal_id = $jadwal->id;
        $antrian->jenispasien = $this->jenispasien;
        $antrian->tanggalperiksa = $this->tanggalperiksa;
        $antrian->nomorkartu = $this->nomorkartu;
        $antrian->nik = $this->nik;
        $antrian->norm = $this->norm;
        $antrian->nohp = $this->nohp;
        $antrian->nama = $this->nama;
        $antrian->jeniskunjungan = '';
        $antrian->pasienbaru = 0;
        $antrian->taskid = 1;
        $antrian->taskid1 = now();
        $antrian->method = 'Web';
        $antrian->kodepoli = $jadwal->kodepoli;
        $antrian->namapoli = $jadwal->namapoli;
        $antrian->kodedokter = $jadwal->kodedokter;
        $antrian->namadokter = $jadwal->namadokter;
        $antrian->jampraktek = $jadwal->jampraktek;
        $antiranhari = Antrian::where('tanggalperiksa', $this->tanggalperiksa)->count();
        $antrianpoli = Antrian::where('tanggalperiksa', $this->tanggalperiksa)->where('jadwal_id', $jadwal->id)->count();
        $antrian->kodebooking = strtoupper(uniqid());
        $antrian->nomorantrean = $jadwal->huruf . $antrianpoli + 1;
        $antrian->angkaantrean = $antiranhari + 1;
        $antrian->save();
        return redirect()->route('antrianonline', $antrian->kodebooking);
    }
    public function cekPasien()
    {
        $this->pasien = Pasien::where('nik', $this->nik)->first();
        if ($this->pasien) {
            $this->norm = $this->pasien->norm;
            $this->nama = $this->pasien->nama;
            $this->nomorkartu = $this->pasien->nomorkartu;
            $this->nik = $this->pasien->nik;
            flash("Pasien Ditemukan", 'success');
        } else {
            flash("NIK Pasien Tidak Ditemukan", 'danger');
        }
    }
    public function cekJadwal()
    {
        $this->jadwals = JadwalDokter::where('hari', Carbon::parse($this->tanggalperiksa)->dayOfWeek)->get();
        if (count($this->jadwals)) {
            flash(count($this->jadwals) . " Jadwal Dokter Ditemukan", 'success');
        } else {
            flash("Jadwal Dihari tersebut tidak ditemukan", 'danger');
        }
    }
    public function render()
    {
        return view('livewire.antrian.daftar-antrian')->layout('components.layouts.layout_medico');
    }
}
