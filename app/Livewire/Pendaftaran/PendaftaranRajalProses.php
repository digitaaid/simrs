<?php

namespace App\Livewire\Pendaftaran;

use App\Http\Controllers\AntrianController;
use App\Models\Antrian;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftaranRajalProses extends Component
{
    public $antrianId, $kodebooking, $nomorkartu, $nik, $norm, $nama, $nohp, $tanggalperiksa, $kodepoli, $kodedokter, $jenispasien;
    public $kunjungan, $kunjunganId, $tgl_lahir, $gender, $hakkelas, $jenispeserta, $kodekunjungan, $counter, $jaminan, $unit, $dokter, $caramasuk, $diagAwal, $jenisKunjungan;
    public $antrian, $pasien;
    public $polikliniks, $dokters, $jaminans;
    protected $listeners = ['modalCppt', 'modalSEP', 'modalSK', 'modalLayanan', 'formAntrian',  'formKunjungan', 'formPasien', 'refreshPage' => '$refresh'];
    public function render()
    {
        $pasiencount = Pasien::count();
        return view('livewire.pendaftaran.pendaftaran-rajal-proses', compact('pasiencount'))->title('Pendaftaran ' . $this->antrian->nama);
    }
    public function batal()
    {
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if (env('ANTRIAN_REALTIME')) {
            $request = new Request([
                'kodebooking' => $this->kodebooking,
                'keterangan' => "Dibatalkan admin pendaftaran",
            ]);
            $api = new AntrianController();
            $res = $api->batal_antrean($request);
            if ($res->metadata->code != 200) {
                flash($res->metadata->message, 'danger');
            }
        }
        $antrian->taskid = 99;
        $antrian->user1 = auth()->user()->id;
        $antrian->update();
        $kunjungan = $antrian->kunjungan;
        if ($kunjungan) {
            $kunjungan->update([
                'status' => 99,
                'user1' => auth()->user()->id,
            ]);
        }
        Alert::success('Success', 'Nomor antrian ' . $antrian->nomorantrean . ' telah dibatalakan pendaftaran.');
        return redirect()->to(route('pendaftaran.rajal.index') . "?tanggalperiksa=" . $antrian->tanggalperiksa);
    }
    public function selesaiPendaftaran()
    {
        $now = now();
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid <= 2) {
            if (env('ANTRIAN_REALTIME')) {
                $request = new Request([
                    'kodebooking' => $this->kodebooking,
                    'waktu' => Carbon::createFromFormat('Y-m-d H:i:s', $antrian->taskid1, 'Asia/Jakarta')->timestamp * 1000,
                    'taskid' => 1,
                ]);
                $api = new AntrianController();
                $res = $api->update_antrean($request);
                $request = new Request([
                    'kodebooking' => $this->kodebooking,
                    'waktu' => Carbon::createFromFormat('Y-m-d H:i:s', $antrian->taskid2, 'Asia/Jakarta')->timestamp * 1000,
                    'taskid' => 2,
                ]);
                $api = new AntrianController();
                $res = $api->update_antrean($request);
                $request = new Request([
                    'kodebooking' => $this->kodebooking,
                    'waktu' => $now,
                    'taskid' => 3,
                ]);
                $api = new AntrianController();
                $res = $api->update_antrean($request);
                if ($res->metadata->code != 200) {
                    if ($res->metadata->message  != 'TaskId=3 sudah ada') {
                        return flash($res->metadata->message, 'danger');
                    }
                }
            }
            $antrian->taskid = 3;
            $antrian->taskid3 = $now;
            $antrian->panggil = 0;
            $antrian->user1 = auth()->user()->id;
            $antrian->update();
            Alert::success('Success', 'Nomor antrian ' . $antrian->nomorantrean . ' telah selesai pendaftaran.');
            return redirect()->to(route('pendaftaran.rajal.index') . "?tanggalperiksa=" . $antrian->tanggalperiksa);
        } else {
            flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan pelayanan.', 'danger');
        }
    }
    public function checkinHadir()
    {
        $now = now();
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid <= 2) {
            if (env('ANTRIAN_REALTIME')) {
                $request = new Request([
                    'kodebooking' => $this->kodebooking,
                    'waktu' => $now,
                    'taskid' => 1,
                ]);
                $api = new AntrianController();
                $res = $api->update_antrean($request);
                if ($res->metadata->code != 200) {
                    return flash($res->metadata->message, 'danger');
                }
            }
            $antrian->taskid1 = $now;
            $antrian->panggil = 0;
            $antrian->taskid = 1;
            $antrian->keterangan = "Anda telah dicheckin oleh admin pendaftaran";
            $antrian->user1 = auth()->user()->id;
            $antrian->update();
            flash('Nomor antrian ' . $antrian->nomorantrean . ' dipanggil.', 'success');
            $this->dispatch('refreshPage');
        } else {
            flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan pelayanan.', 'danger');
        }
    }
    public function panggilPendaftaran()
    {
        $now = now();
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid <= 2) {
            if (env('ANTRIAN_REALTIME')) {
                $request = new Request([
                    'kodebooking' => $this->kodebooking,
                    'waktu' =>  $now,
                    'taskid' => 2,
                ]);
                $api = new AntrianController();
                $res = $api->update_antrean($request);
            }
            $antrian->taskid2 = $now;
            $antrian->panggil = 0;
            $antrian->taskid = 2;
            $antrian->user1 = auth()->user()->id;
            $antrian->update();
            flash('Nomor antrian ' . $antrian->nomorantrean . ' dipanggil.', 'success');
            $this->dispatch('refreshPage');
        } else {
            flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan pelayanan.', 'danger');
        }
    }
    public function mount($kodebooking)
    {
        $antrian = Antrian::firstWhere('kodebooking', $kodebooking);
        if ($antrian) {
            $this->antrian = $antrian;
            $this->kunjungan = $antrian->kunjungan;
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
            return redirect()->route('pendaftaran.rajal.index');
        }
    }
}
