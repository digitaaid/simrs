<?php

namespace App\Livewire\Dokter;

use App\Models\Antrian;
use Livewire\Component;

class PemeriksaanDokterRajalProses extends Component
{
    public $antrianId, $kodebooking, $nomorkartu, $nik, $norm, $nama, $nohp, $tanggalperiksa, $kodepoli, $kodedokter, $jenispasien;
    public $kunjunganId, $tgl_lahir, $gender, $hakkelas, $jenispeserta, $kodekunjungan, $counter, $jaminan, $unit, $dokter, $caramasuk, $diagAwal, $jenisKunjungan;
    public $antrian;
    public $polikliniks, $dokters, $jaminans;
    public $openmodalAsesmenRajal = false;
    public $openmodalPerawat = false;
    public $openmodalDokter = false;
    protected $listeners = ['modalAsesmenRajal',  'modalPemeriksaanPerawat', 'modalPemeriksaanDokter', 'refreshPage' => '$refresh'];
    public function panggilPemeriksaan()
    {
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid <= 4) {
            $antrian->taskid = 4;
            $antrian->taskid4 = now();
            $antrian->panggil = 0;
            $antrian->user3 = auth()->user()->id;
            $antrian->update();
            flash('Nomor antrian ' . $antrian->nomorantrean . ' dipanggil.', 'success');
        } else {
            flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan pelayanan.', 'danger');
        }
    }
    public function selesaiPelayanan()
    {
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid <= 4) {
            $antrian->taskid = 5;
            $antrian->taskid5 = now();
            $antrian->panggil = 1;
            $antrian->status = 1;
            $antrian->user3 = auth()->user()->id;
            $antrian->update();
            flash('Nomor antrian ' . $antrian->nomorantrean . ' telah selesai pelayanan.', 'success');
            return redirect()->to(route('pemeriksaan.dokter.rajal') . "?tanggalperiksa=" . $antrian->tanggalperiksa);
        } else {
            flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan obat.', 'danger');
        }
    }
    public function lanjutFarmasi()
    {
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid <= 4) {
            $antrian->taskid = 5;
            $antrian->taskid3 = now();
            $antrian->panggil = 0;
            $antrian->status = 0;
            $antrian->user3 = auth()->user()->id;
            $antrian->update();
            flash('Nomor antrian ' . $antrian->nomorantrean . ' telah dilanjutkan ke farmasi.', 'success');
            return redirect()->to(route('pemeriksaan.dokter.rajal') . "?tanggalperiksa=" . $antrian->tanggalperiksa);
        } else {
            flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan obat.', 'danger');
        }
    }
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
        return view('livewire.dokter.pemeriksaan-dokter-rajal-proses')->title('Pemeriksaan Perawat ' . $this->antrian->nama);
    }
}
