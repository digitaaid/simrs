<?php

namespace App\Livewire\Pendaftaran;

use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Jaminan;
use App\Models\Pasien;
use App\Models\Unit;
use Livewire\Component;

class PendaftaranRajalErm extends Component
{
    public $antrianId, $kodebooking, $nomorkartu, $nik, $norm, $nama, $nohp, $tanggalperiksa, $kodepoli, $kodedokter, $jenispasien;
    public $kunjunganId, $tgl_lahir, $gender, $hakkelas, $jenispeserta, $kodekunjungan, $counter, $jaminan, $unit, $dokter, $caramasuk, $diagAwal, $jenisKunjungan;
    public $antrian;
    public $polikliniks,$dokters, $jaminans;
    public $openformAntrian = false;
    public $openformKunjungan = false;
    public function dataPasien()
    {
        dd('datapasien');
    }
    public function formKunjungan()
    {
        $this->openformKunjungan = true;
    }
    public function closeformKunjungan()
    {
        $this->openformKunjungan = false;
    }
    public function editAntrian()
    {
        dd($this->nomorkartu);
    }
    public function formAntrian()
    {
        $this->openformAntrian = true;
    }
    public function closeformAntrian()
    {
        $this->openformAntrian = false;
    }
    public function mount($kodebooking)
    {
        $this->kodebooking = $kodebooking;
        $antrian = Antrian::firstWhere('kodebooking', $kodebooking);
        $this->antrianId = $antrian->id;
        $this->nomorkartu = $antrian->nomorkartu;
        $this->nik = $antrian->nik;
        $this->norm = $antrian->norm;
        $this->nama = $antrian->nama;
        $this->nohp = $antrian->nohp;
        $this->tanggalperiksa = $antrian->tanggalperiksa;
        $this->jenispasien = $antrian->jenispasien;
        $this->kodepoli = $antrian->kodepoli;
        $this->kodedokter = $antrian->kodedokter;
    }
    public function render()
    {
        $this->antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        $pasiencount = Pasien::count();
        $this->polikliniks = Unit::pluck('nama', 'kode');
        $this->dokters = Dokter::pluck('nama', 'kode');
        // $this->jaminans = Jaminan::pluck('nama', 'kode');
        return view('livewire.pendaftaran.pendaftaran-rajal-erm', compact('pasiencount'))->title('Pendaftaran ' . $this->antrian->nama);
    }
}
