<?php

namespace App\Livewire\Pendaftaran;

use App\Http\Controllers\VclaimController;
use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Unit;
use Livewire\Component;

class ModalAntrianRajal extends Component
{
    public $antrian, $polikliniks, $dokters;
    public $antrianId, $kodebooking, $nomorkartu, $nik, $norm, $nama, $nohp, $tanggalperiksa, $kodepoli, $kodedokter, $jenispasien;
    public function editAntrian()
    {
        $antrian = Antrian::find($this->antrianId);
        $antrian->update([
            'nomorkartu' => $this->nomorkartu,
            'nik' => $this->nik,
            'norm' => $this->norm,
            'nama' => $this->nama,
            'nohp' => $this->nohp,
            'tanggalperiksa' => $this->tanggalperiksa,
            'kodepoli' => $this->kodepoli,
            'kodedokter' => $this->kodedokter,
            'jenispasien' => $this->jenispasien,
        ]);
        flash('Antrian atas nama pasien ' . $antrian->nama .  ' saved successfully.', 'success');
    }
    public function closeformAntrian()
    {
        $this->dispatch('closeformAntrian');
    }
    public function cariNomorKartu()
    {
        $pasien = Pasien::where('nomorkartu', $this->nomorkartu)->first();
        if ($pasien) {
            $this->nik = $pasien->nik;
            $this->nomorkartu = $pasien->nomorkartu;
            $this->norm = $pasien->norm;
            $this->nama = $pasien->nama;
            $this->nohp = $pasien->nohp;
        }
    }
    public function cariNIK()
    {
        $pasien = Pasien::where('nik', $this->nik)->first();
        if ($pasien) {
            $this->nomorkartu = $pasien->nomorkartu;
            $this->nik = $pasien->nik;
            $this->norm = $pasien->norm;
            $this->nama = $pasien->nama;
            $this->nohp = $pasien->nohp;
        }
    }
    public function cariNoRM()
    {
        $pasien = Pasien::where('norm', $this->norm)->first();
        if ($pasien) {
            $this->nomorkartu = $pasien->nomorkartu;
            $this->nik = $pasien->nik;
            $this->norm = $pasien->norm;
            $this->nama = $pasien->nama;
            $this->nohp = $pasien->nohp;
        }
    }
    public function mount(Antrian $antrian)
    {
        $this->antrian = $antrian;
        $this->antrianId = $antrian->id;
        $this->kodebooking = $antrian->kodebooking;
        $this->nomorkartu = $antrian->nomorkartu;
        $this->nik = $antrian->nik;
        $this->norm = $antrian->norm;
        $this->nama = $antrian->nama;
        $this->nohp = $antrian->nohp;
        $this->tanggalperiksa = $antrian->tanggalperiksa;
        $this->kodepoli = $antrian->kodepoli;
        $this->kodedokter = $antrian->kodedokter;
        $this->jenispasien = $antrian->jenispasien;
        $this->polikliniks = Unit::pluck('nama', 'kode');
        $this->dokters = Dokter::pluck('nama', 'kode');
    }
    public function render()
    {
        return view('livewire.pendaftaran.modal-antrian-rajal');
    }
}
