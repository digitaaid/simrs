<?php

namespace App\Livewire\Pendaftaran;

use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Jaminan;
use App\Models\Pasien;
use App\Models\Unit;
use Livewire\Component;

class PendaftaranRajalProses extends Component
{
    public $antrianId, $kodebooking, $nomorkartu, $nik, $norm, $nama, $nohp, $tanggalperiksa, $kodepoli, $kodedokter, $jenispasien;
    public $kunjunganId, $tgl_lahir, $gender, $hakkelas, $jenispeserta, $kodekunjungan, $counter, $jaminan, $unit, $dokter, $caramasuk, $diagAwal, $jenisKunjungan;
    public $antrian;
    public $polikliniks, $dokters, $jaminans;
    public $openformAntrian = false;
    public $openformKunjungan = false;
    public $openformPasien = false;

    protected $listeners = ['closeformAntrian',  'closeformKunjungan', 'closeformPasien'];
    public function formPasien()
    {
        $this->openformPasien =  $this->openformPasien ? false : true;
    }
    public function closeformPasien()
    {
        $this->openformPasien = false;
    }
    public function formKunjungan()
    {
        $this->openformKunjungan = $this->openformKunjungan ? false : true;
    }
    public function closeformKunjungan()
    {
        $this->openformKunjungan = false;
    }
    public function formAntrian()
    {
        $this->openformAntrian = $this->openformAntrian ? false : true;
    }
    public function closeformAntrian()
    {
        $this->openformAntrian = false;
    }
    public function mount($kodebooking)
    {
        $antrian = Antrian::firstWhere('kodebooking', $kodebooking);
        if ($antrian) {
            $this->antrian = $antrian;
            $this->kodebooking = $kodebooking;
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
        } else {
            flash('Antrian tidak ditemukan.', 'danger');
            return redirect()->route('pendaftaran.rajal');
        }
    }
    public function render()
    {
        $pasiencount = Pasien::count();
        return view('livewire.pendaftaran.pendaftaran-rajal-proses', compact('pasiencount'))->title('Pendaftaran ' . $this->antrian->nama);
    }
}
