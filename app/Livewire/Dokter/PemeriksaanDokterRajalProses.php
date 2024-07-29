<?php

namespace App\Livewire\Dokter;

use App\Http\Controllers\AntrianController;
use App\Models\Antrian;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class PemeriksaanDokterRajalProses extends Component
{
    use WithPagination;
    public $antrianId, $kodebooking, $nomorkartu, $nik, $norm, $nama, $nohp, $tanggalperiksa, $kodepoli, $kodedokter, $jenispasien;
    public $kunjunganId, $tgl_lahir, $gender, $hakkelas, $jenispeserta, $kodekunjungan, $counter, $jaminan, $unit, $dokter, $caramasuk, $diagAwal, $jenisKunjungan;
    public $antrian, $pasien;
    public $polikliniks, $dokters, $jaminans;
    public $openmodalCppt = false;
    public $openmodalLayanan = false;
    public $openmodalAsesmenRajal = false;
    public $openmodalPerawat = false;
    public $openmodalDokter = false;
    protected $listeners = ['modalCppt', 'modalAsesmenRajal',  'modalPemeriksaanPerawat', 'modalPemeriksaanDokter', 'refreshPage' => '$refresh'];
    public function panggilPemeriksaanMute()
    {
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid <= 4) {
            $antrian->taskid = 4;
            $antrian->taskid4 = now();
            $antrian->panggil = 1;
            $antrian->user3 = auth()->user()->id;
            $antrian->update();
            if (env('ANTRIAN_REALTIME')) {
                $request = new Request([
                    'kodebooking' => $this->kodebooking,
                    'waktu' => now(),
                    'taskid' => 4,
                ]);
                $api = new AntrianController();
                $res = $api->update_antrean($request);
                if ($res->metadata->code != 200) {
                    return flash($res->metadata->message, 'danger');
                }
            }
            flash('Nomor antrian ' . $antrian->nomorantrean . ' dipanggil.', 'success');
        } else {
            flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan pelayanan.', 'danger');
        }
        $this->dispatch('refreshPage');
    }
    public function panggilPemeriksaan()
    {
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid <= 4) {
            $antrian->taskid = 4;
            $antrian->taskid4 = now();
            $antrian->panggil = 0;
            $antrian->user3 = auth()->user()->id;
            $antrian->update();
            if (env('ANTRIAN_REALTIME')) {
                $request = new Request([
                    'kodebooking' => $this->kodebooking,
                    'waktu' => now(),
                    'taskid' => 4,
                ]);
                $api = new AntrianController();
                $res = $api->update_antrean($request);
                if ($res->metadata->code != 200) {
                    return flash($res->metadata->message, 'danger');
                }
            }
            flash('Nomor antrian ' . $antrian->nomorantrean . ' dipanggil.', 'success');
        } else {
            flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan pelayanan.', 'danger');
        }
        $this->dispatch('refreshPage');
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
            if (env('ANTRIAN_REALTIME')) {
                $request = new Request([
                    'kodebooking' => $this->kodebooking,
                    'waktu' => now(),
                    'taskid' => 5,
                ]);
                $api = new AntrianController();
                $res = $api->update_antrean($request);
                if ($res->metadata->code != 200) {
                    return flash($res->metadata->message, 'danger');
                }
            }
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
            if (env('ANTRIAN_REALTIME')) {
                $request = new Request([
                    'kodebooking' => $this->kodebooking,
                    'waktu' => now(),
                    'taskid' => 5,
                ]);
                $api = new AntrianController();
                $res = $api->update_antrean($request);
                if ($res->metadata->code != 200) {
                    return flash($res->metadata->message, 'danger');
                }
            }
            $antrian->taskid = 5;
            $antrian->taskid5 = now();
            $antrian->panggil = 0;
            $antrian->status = 0;
            $antrian->user3 = auth()->user()->id;
            $antrian->update();
            flash('Nomor antrian ' . $antrian->nomorantrean . ' telah dilanjutkan ke farmasi.', 'success');
            return redirect()->to(route('pemeriksaan.dokter.rajal') . "?tanggalperiksa=" . $antrian->tanggalperiksa . "&jadwal=" . $antrian->jadwal_id);
        } else {
            flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan obat.', 'danger');
        }
        $this->dispatch('refreshPage');
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
        $antrian = Antrian::where('kodebooking', $kodebooking)
            ->first();
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
            $this->pasien =  $antrian->pasien;
            $this->openmodalCppt = true;
        } else {
            flash('Antrian tidak ditemukan.', 'danger');
            return redirect()->route('pendaftaran.rajal');
        }
    }
    public function render()
    {
        return view('livewire.dokter.pemeriksaan-dokter-rajal-proses')->title('Pemeriksaan Dokter ' . $this->antrian->nama);
    }
}
