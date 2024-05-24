<?php

namespace App\Livewire\Perawat;

use App\Models\Antrian;
use App\Models\Pasien;
use Livewire\Component;

class PemeriksaanPerawatRajalProses extends Component
{
    public $antrianId, $kodebooking, $nomorkartu, $nik, $norm, $nama, $nohp, $tanggalperiksa, $kodepoli, $kodedokter, $jenispasien;
    public $kunjunganId, $tgl_lahir, $gender, $hakkelas, $jenispeserta, $kodekunjungan, $counter, $jaminan, $unit, $dokter, $caramasuk, $diagAwal, $jenisKunjungan;
    public $antrian;
    public $polikliniks, $dokters, $jaminans;
    public $openmodalAsesmenRajal = false;
    public $openmodalPerawat = false;
    public $openmodalDokter = false;
    protected $listeners = ['modalAsesmenRajal',  'modalPemeriksaanPerawat', 'modalPemeriksaanDokter', 'refreshPage' => '$refresh'];
    public function modalAsesmenRajal()
    {
        $this->openmodalAsesmenRajal = $this->openmodalAsesmenRajal ? false : true;
    }
    public function modalPemeriksaanPerawat()
    {
        $this->openmodalPerawat = $this->openmodalPerawat ? false : true;
    }
    public function modalPemeriksaanDokter()
    {
        $this->openmodalDokter =  $this->openmodalDokter ? false : true;
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
        return view('livewire.perawat.pemeriksaan-perawat-rajal-proses')->title('Pemeriksaan Perawat ' . $this->antrian->nama);
    }
}
