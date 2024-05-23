<?php

namespace App\Livewire\Pendaftaran;

use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Jaminan;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Unit;
use Carbon\Carbon;
use Livewire\Component;

class ModalKunjunganRajal extends Component
{
    public $antrian, $jaminans, $polikliniks, $dokters;
    public $antrianId, $kodebooking, $nomorkartu, $nik, $norm, $nama, $tgl_lahir, $gender, $hakkelas, $jenispeserta, $kodekunjungan, $counter, $jaminan, $tgl_masuk, $unit, $dokter, $caramasuk, $diag_awal, $jeniskunjungan, $nomorreferensi, $sep;
    public function editKunjungan()
    {
        $antrian = Antrian::find($this->antrianId);
        $counter = Kunjungan::where('norm', $antrian->norm)->first()?->counter ?? 1;
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
            'diagnosa_awal' => $this->diag_awal,
            'cara_masuk' => $this->caramasuk,
            'status' => 1,
            'user1' => auth()->user()->id,
        ]);
        // update antrian
        $antrian->update([
            'kunjungan_id' => $kunjungan->id,
            'kodekunjungan' => $kunjungan->kode,
            'user1' =>auth()->user()->id,
        ]);
        // masukan tarif
        flash('Kunjungan atas nama pasien ' . $antrian->nama .  ' saved successfully.', 'success');
    }
    public function carNomorKartu()
    {
        $pasien = Pasien::where('nomorkartu', $this->nomorkartu)->first();
        if ($pasien) {
            $this->nik = $pasien->nik;
            $this->nomorkartu = $pasien->nomorkartu;
            $this->norm = $pasien->norm;
            $this->nama = $pasien->nama;
            $this->tgl_lahir = $pasien->tgl_lahir;
            $this->gender = $pasien->gender;
            $this->hakkelas = $pasien->hakkelas;
            $this->jenispeserta = $pasien->jenispeserta;
        }
    }
    public function cariNIK()
    {
        $pasien = Pasien::where('nik', $this->nik)->first();
        if ($pasien) {
            $this->nomorkartu = $pasien->nomorkartu;
            $this->nik = $pasien->nik;
            $this->norm = $pasien->norm;
            $this->nama = $pasien->nama;
            $this->tgl_lahir = $pasien->tgl_lahir;
            $this->gender = $pasien->gender;
            $this->hakkelas = $pasien->hakkelas;
            $this->jenispeserta = $pasien->jenispeserta;
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
            $this->hakkelas = $pasien->hakkelas;
            $this->jenispeserta = $pasien->jenispeserta;
        }
    }
    public function closeformKunjungan()
    {
        $this->dispatch('closeformKunjungan');
    }
    public function mount(Antrian $antrian)
    {
        $this->antrian = $antrian;
        $this->antrianId = $antrian->id;
        $this->kodebooking = $antrian->kodebooking;
        $this->nomorkartu = $antrian->nomorkartu;
        $this->nik = $antrian->nik;
        $this->norm = $antrian->norm;
        $this->nama = $antrian->nama;
        $this->unit = $antrian->kodepoli;
        $this->dokter = $antrian->kodedokter;
        $this->jeniskunjungan = $antrian->jeniskunjungan;
        $this->polikliniks = Unit::pluck('nama', 'kode');
        $this->dokters = Dokter::pluck('nama', 'kode');
        $this->jaminans = Jaminan::pluck('nama', 'kode');
    }
    public function render()
    {
        return view('livewire.pendaftaran.modal-kunjungan-rajal');
    }
}
