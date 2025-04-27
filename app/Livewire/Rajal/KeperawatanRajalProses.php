<?php

namespace App\Livewire\Rajal;

use App\Models\Antrian;
use App\Models\Pasien;
use Livewire\Component;

class KeperawatanRajalProses extends Component
{
    public $antrianId, $kodebooking, $nomorkartu, $nik, $norm, $nama, $nohp, $tanggalperiksa, $kodepoli, $kodedokter, $jenispasien;
    public $kunjunganId, $tgl_lahir, $gender, $hakkelas, $jenispeserta, $kodekunjungan, $counter, $jaminan, $unit, $dokter, $caramasuk, $diagAwal, $jenisKunjungan;
    public $antrian, $pasien;
    public $polikliniks, $dokters, $jaminans;
    public $openmodalCppt = false;
    public $openmodalLayanan = false;
    public $openmodalAsesmenRajal = false;
    public $openmodalPerawat = false;
    public $openmodalDokter = false;
    protected $listeners = ['modalAsesmenRajal', 'modalCppt', 'modalPemeriksaanPerawat', 'modalPemeriksaanDokter', 'refreshPage' => '$refresh'];
    public function render()
    {
        return view('livewire.rajal.keperawatan-rajal-proses')->title('Pemeriksaan Perawat ' . $this->antrian->nama);
    }
    public function selesaiPerawat()
    {
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid <= 4) {
            $antrian->user2 = auth()->user()->id;
            $antrian->update();
            flash('Nomor antrian ' . $antrian->nomorantrean . ' telah selesai pemeriksaan perawat.', 'success');
            return redirect()->to(route('perawat.rajal.pemeriksaan') . "?tanggalperiksa=" . $antrian->tanggalperiksa);
        } else {
            flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan obat.', 'danger');
        }
    }
    public function modalCppt()
    {
        $this->openmodalCppt = $this->openmodalCppt ? false : true;
    }
    public function modalLayanan()
    {
        $this->openmodalLayanan = $this->openmodalLayanan ? false : true;
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
            $this->pasien = $antrian->pasien;
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
}
