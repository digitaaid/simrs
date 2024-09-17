<?php

namespace App\Livewire\Igd;

use App\Http\Controllers\VclaimController;
use App\Models\Dokter;
use App\Models\Jaminan;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class ModalKunjunganIgd extends Component
{
    public $jaminans, $units, $dokters;
    public $norm, $nohp, $nomorkartu, $nama, $nik, $tgl_lahir, $jenispeserta, $fktp, $hakkelas, $gender;
    public $kode, $counter, $tgl_masuk, $unit, $dokter, $cara_masuk, $jeniskunjungan, $penjamin, $nomorreferensi, $sep;


    public function editKunjungan()
    {
        $this->validate([
            'norm' => 'required',
            'nohp' => 'required',
            'nomorkartu' => 'required',
            'nik' => 'required|digits:16',
            'nama' => 'required',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'hakkelas' => 'required',
            'jenispeserta' => 'required',
            'tgl_masuk' => 'required',
            'penjamin' => 'required',
            'unit' => 'required',
            'dokter' => 'required',
            'cara_masuk' => 'required',
            'jeniskunjungan' => 'required',
        ]);
        if (!$this->kode && !$this->counter) {
            # code...
            $this->counter = Kunjungan::where('norm', $this->norm)->first()?->counter ?? 1;
            $this->kode = strtoupper(uniqid());
        }
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
        $kunjungan = Kunjungan::updateOrCreate([
            'kode' => $this->kode,
            'counter' => $this->counter,
        ], [
            'tgl_masuk' => Carbon::parse($this->tgl_masuk),
            'jaminan' => $this->penjamin,
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
            'cara_masuk' => $this->cara_masuk,
            'status' => 1,
            'user1' => auth()->user()->id,
        ]);
        dd($this->all(), $kunjungan);
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
            $this->nik = $pasien->nik;
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
            $this->tgl_lahir = $pasien->tgl_lahir;
            $this->gender = $pasien->gender;
            $this->jenispeserta = $pasien->jenispeserta;
        }
    }
    public function mount()
    {
        $this->jaminans = Jaminan::pluck('nama', 'kode');
        $this->units = Unit::where("jenis", "Pelayanan IGD")->pluck('nama', 'kode');
        $this->dokters = Dokter::pluck('nama', 'kode');
    }
    public function render()
    {
        return view('livewire.igd.modal-kunjungan-igd');
    }
}
