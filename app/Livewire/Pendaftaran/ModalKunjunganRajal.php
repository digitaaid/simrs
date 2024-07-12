<?php

namespace App\Livewire\Pendaftaran;

use App\Http\Controllers\VclaimController;
use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Jaminan;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class ModalKunjunganRajal extends Component
{
    public $antrian, $jaminans, $polikliniks, $dokters;
    public $diagnosas = [];
    public $antrianId, $kodebooking, $nomorkartu, $nik, $norm, $nama, $tgl_lahir, $nohp, $fktp, $gender, $hakkelas, $jenispeserta, $kode, $counter, $jaminan, $tgl_masuk, $unit, $dokter, $caramasuk, $diagnosa, $jeniskunjungan, $nomorreferensi, $sep;
    public function updatedDiagnosa()
    {
        $this->validate([
            'diagnosa' => 'required|min:3',
        ]);
        try {
            $api = new VclaimController();
            $request = new Request([
                'diagnosa' => $this->diagnosa,
            ]);
            $res = $api->ref_diagnosa($request);
            if ($res->metadata->code == 200) {
                $this->diagnosas = [];
                foreach ($res->response->diagnosa as $key => $value) {
                    $this->diagnosas[] = [
                        'kode' => $value->kode,
                        'nama' => $value->nama,
                    ];
                }
            } else {
                return flash($res->metadata->message, 'danger');
            }
        } catch (\Throwable $th) {
            return flash($th->getMessage(), 'danger');
        }
    }
    public function editKunjungan()
    {
        $this->validate([
            'kodebooking' => 'required',
            'nomorkartu' => 'required',
            'nik' => 'required|digits:16',
            'norm' => 'required',
            'nama' => 'required',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'hakkelas' => 'required',
            'jenispeserta' => 'required',
            'tgl_masuk' => 'required',
            'jaminan' => 'required',
            'unit' => 'required',
            'dokter' => 'required',
            'caramasuk' => 'required',
            'jeniskunjungan' => 'required',
        ]);
        try {
            $antrian = Antrian::find($this->antrianId);
            $counter = Kunjungan::where('norm', $antrian->norm)->first()?->counter ?? 1;
            // update pasien
            $pasien = Pasien::firstWhere('norm', $this->norm);
            $pasien->update([
                'nomorkartu' => $this->nomorkartu,
                'nik' => $this->nik,
                'nama' => $this->nama,
                'tgl_lahir' => $this->tgl_lahir,
                'gender' => $this->gender,
                'hakkelas' => $this->hakkelas,
                'jenispeserta' => $this->jenispeserta,
            ]);
            // simpan kunjungan
            $kunjungan = Kunjungan::updateOrCreate([
                'kode' => $antrian->kodebooking,
                'counter' => $counter,
            ], [
                'tgl_masuk' => Carbon::parse($this->tgl_masuk),
                'jaminan' => $this->jaminan,
                'nomorkartu' => $this->nomorkartu,
                'nik' => $this->nik,
                'norm' => $this->norm,
                'nama' => $this->nama,
                'tgl_lahir' => $this->tgl_lahir,
                'gender' => $this->gender,
                'kelas' => $this->hakkelas,
                'penjamin' => $this->jenispeserta,
                'unit' => $this->unit,
                'dokter' => $this->dokter,
                'jeniskunjungan' => $this->jeniskunjungan,
                'nomorreferensi' => $this->nomorreferensi,
                'sep' => $this->sep,
                'diagnosa_awal' => $this->diagnosa,
                'cara_masuk' => $this->caramasuk,
                'status' => 1,
                'user1' => auth()->user()->id,
            ]);
            // update antrian
            $antrian->update([
                'kunjungan_id' => $kunjungan->id,
                'kodekunjungan' => $kunjungan->kode,
                'sep' => $this->sep,
                'user1' => auth()->user()->id,
            ]);
            // masukan tarif
            flash('Kunjungan atas nama pasien ' . $antrian->nama .  ' saved successfully.', 'success');
        } catch (\Throwable $th) {
            flash($th->getMessage(), 'danger');
        }
        $this->dispatch('refreshPage');
    }
    public function cariNomorKartu()
    {
        $request = new Request([
            'nomorkartu' => $this->nomorkartu,
            'tanggal' => now()->format('Y-m-d'),
        ]);
        $pasien = Pasien::where('nomorkartu', $this->nomorkartu)->first();
        if ($pasien) {
            $this->norm = $pasien->norm;
            $this->nohp = $pasien->nohp;
        }
        $api = new VclaimController();
        $res =  $api->peserta_nomorkartu($request);
        if ($res->metadata->code == 200) {
            $peserta = $res->response->peserta;
            $this->nama = $peserta->nama;
            $this->nomorkartu = $peserta->noKartu;
            $this->nik = $peserta->nik;
            $this->tgl_lahir = $peserta->tglLahir;
            $this->fktp = $peserta->provUmum->nmProvider;
            $this->jenispeserta = $peserta->jenisPeserta->keterangan;
            $this->hakkelas = $peserta->hakKelas->kode;
            $this->gender = $peserta->sex;
            flash($res->metadata->message, 'success');
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
    public function cariNIK()
    {
        $request = new Request([
            'nik' => $this->nik,
            'tanggal' => now()->format('Y-m-d'),
        ]);
        $pasien = Pasien::where('nik', $this->nik)->first();
        if ($pasien) {
            $this->norm = $pasien->norm;
            $this->nohp = $pasien->nohp;
        }
        $api = new VclaimController();
        $res =  $api->peserta_nik($request);
        if ($res->metadata->code == 200) {
            $peserta = $res->response->peserta;
            $this->nama = $peserta->nama;
            $this->nomorkartu = $peserta->noKartu;
            $this->nik = $peserta->nik;
            $this->tgl_lahir = $peserta->tglLahir;
            $this->fktp = $peserta->provUmum->nmProvider;
            $this->jenispeserta = $peserta->jenisPeserta->keterangan;
            $this->hakkelas = $peserta->hakKelas->kode;
            $this->gender = $peserta->sex;
            flash($res->metadata->message, 'success');
        } else {
            flash($res->metadata->message, 'danger');
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
    public function formKunjungan()
    {
        $this->dispatch('formKunjungan');
    }
    public function mount(Antrian $antrian)
    {
        $this->antrian = $antrian;
        $this->antrianId = $antrian->id;
        $this->kodebooking = $antrian->kodebooking;
        $this->nomorkartu = $antrian->kunjungan?->nomorkartu;
        $this->nik = $antrian->nik;
        $this->norm = $antrian->kunjungan?->norm;
        $this->nama = $antrian->kunjungan?->nama;
        $this->tgl_lahir = $antrian->kunjungan?->tgl_lahir;
        $this->gender = $antrian->kunjungan?->gender;
        $this->hakkelas = $antrian->kunjungan?->kelas;
        $this->jenispeserta = $antrian->kunjungan?->penjamin;
        $this->kode = $antrian->kunjungan?->kode;
        $this->counter = $antrian->kunjungan?->counter;
        $this->tgl_masuk = $antrian->kunjungan?->tgl_masuk;
        $this->jaminan = $antrian->kunjungan?->jaminan;
        $this->unit = $antrian->kunjungan?->unit;
        $this->dokter = $antrian->kunjungan?->dokter;
        $this->caramasuk = $antrian->kunjungan?->cara_masuk;
        $this->diagnosa = $antrian->kunjungan?->diagnosa_awal;
        $this->nomorreferensi = $antrian->kunjungan?->nomorreferensi;
        $this->sep = $antrian->kunjungan?->sep;
        $this->jeniskunjungan =  $antrian->kunjungan?->jeniskunjungan;
        $this->polikliniks = Unit::where("jenis", "Pelayanan Rawat Jalan")->pluck('nama', 'kode');
        $this->dokters = Dokter::pluck('nama', 'kode');
        $this->jaminans = Jaminan::pluck('nama', 'kode');
    }
    public function render()
    {
        return view('livewire.pendaftaran.modal-kunjungan-rajal');
    }
}
