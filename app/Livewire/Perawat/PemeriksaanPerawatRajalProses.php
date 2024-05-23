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
    public $openformAntrian = false;
    public $openformKunjungan = false;
    public $openformPasien = false;
    protected $listeners = ['closeformAntrian',  'closeformKunjungan', 'closeformPasien'];
    public function selesaiPendaftaran()
    {
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid <= 2) {
            $antrian->taskid = 3;
            $antrian->taskid3 = now();
            $antrian->panggil = 0;
            $antrian->update();
            flash('Nomor antrian ' . $antrian->nomorantrean . ' telah selesai pendaftaran.', 'success');
            return redirect()->to(route('pendaftaran.rajal') . "?tanggalperiksa=" . $antrian->tanggalperiksa);
        } else {
            flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan pelayanan.', 'danger');
        }
    }
    public function panggilPendaftaran()
    {
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid <= 2) {
            $antrian->taskid2 = now();
            $antrian->panggil = 0;
            $antrian->taskid = 2;
            $antrian->update();
            flash('Nomor antrian ' . $antrian->nomorantrean . ' dipanggil.', 'success');
        } else {
            flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan pelayanan.', 'danger');
        }
    }
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
        return view('livewire.perawat.pemeriksaan-perawat-rajal-proses', compact('pasiencount'))->title('Pemeriksaan Perawat ' . $this->antrian->nama);
    }
}
