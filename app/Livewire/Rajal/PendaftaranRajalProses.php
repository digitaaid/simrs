<?php

namespace App\Livewire\Rajal;

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
    protected $listeners = ['modalCppt', 'modalSEP', 'modalSK', 'modalLayanan', 'formAntrian', 'formKunjungan', 'formPasien', 'refreshPage' => '$refresh'];
    public function render()
    {
        $pasiencount = Pasien::count();
        return view('livewire.rajal.pendaftaran-rajal-proses', compact('pasiencount'))->title('Pendaftaran ' . $this->antrian->nama);
    }
    private function updateAntrianTask($taskid, $waktu = null)
    {
        $now = $waktu ?? now();
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if (env('ANTRIAN_REALTIME')) {
            $request = new Request([
                'kodebooking' => $this->kodebooking,
                'waktu' => $now,
                'taskid' => $taskid,
            ]);
            $api = new AntrianController();
            $res = $api->update_antrean($request);

            if ($res->metadata->code != 200 && $res->metadata->message != "TaskId=$taskid sudah ada") {
                return flash($res->metadata->message, 'danger');
            }
        }
        $antrian->update([
            "taskid" => $taskid,
            "taskid$taskid" => $now,
            'panggil' => 0,
            'user1' => auth()->user()->id,
        ]);
        return $antrian;
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
                return flash($res->metadata->message, 'danger');
            }
        }
        $antrian->update([
            'taskid' => 99,
            'user1' => auth()->user()->id,
        ]);
        if ($antrian->kunjungan) {
            $antrian->kunjungan->update([
                'status' => 99,
                'user1' => auth()->user()->id,
            ]);
        }
        Alert::success('Success', 'Nomor antrian ' . $antrian->nomorantrean . ' telah dibatalkan pendaftaran.');
        return redirect()->to(route('pendaftaran.rajal.index') . "?tanggalperiksa=" . $antrian->tanggalperiksa);
    }
    public function selesaiPendaftaran()
    {
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid > 2) {
            return flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan pelayanan.', 'danger');
        }
        $this->updateAntrianTask(1, Carbon::createFromFormat('Y-m-d H:i:s', $antrian->taskid1, 'Asia/Jakarta')->timestamp * 1000);
        $this->updateAntrianTask(2, Carbon::createFromFormat('Y-m-d H:i:s', $antrian->taskid2, 'Asia/Jakarta')->timestamp * 1000);
        $this->updateAntrianTask(3);
        Alert::success('Success', 'Nomor antrian ' . $antrian->nomorantrean . ' telah selesai pendaftaran.');
        return redirect()->to(route('pendaftaran.rajal.index') . "?tanggalperiksa=" . $antrian->tanggalperiksa);
    }
    public function checkinHadir()
    {
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid > 2) {
            return flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan pelayanan.', 'danger');
        }
        $this->updateAntrianTask(1);
        flash('Nomor antrian ' . $antrian->nomorantrean . ' dipanggil.', 'success');
        $this->dispatch('refreshPage');
    }
    public function panggilPendaftaran()
    {
        $antrian = Antrian::firstWhere('kodebooking', $this->kodebooking);
        if ($antrian->taskid > 2) {
            return flash('Nomor antrian ' . $antrian->nomorantrean . ' sudah mendapatkan pelayanan.', 'danger');
        }
        $this->updateAntrianTask(2);
        flash('Nomor antrian ' . $antrian->nomorantrean . ' dipanggil.', 'success');
        $this->dispatch('refreshPage');
    }
    public function mount($kodebooking)
    {
        $antrian = Antrian::firstWhere('kodebooking', $kodebooking);
        if (!$antrian) {
            flash('Antrian tidak ditemukan.', 'danger');
            return redirect()->route('pendaftaran.rajal.index');
        }
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
    }
}
