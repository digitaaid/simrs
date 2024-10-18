<?php

namespace App\Livewire\Igd;

use App\Models\Bed;
use App\Models\Dokter;
use App\Models\Jaminan;
use App\Models\Kamar;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Unit;
use Carbon\Carbon;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ModalTransferRanap extends Component
{
    public $kunjungan, $kunjunganranap;
    public $jaminans, $units, $dokters, $beds = [];
    public $bed, $norm, $nohp, $nomorkartu, $nama, $nik, $tgl_lahir, $jenispeserta, $fktp, $hakkelas, $gender;
    public $kode_transfer, $kode, $counter, $tgl_transfer, $unit, $dokter, $cara_masuk, $jeniskunjungan, $penjamin, $nomorreferensi, $sep;

    public function editKunjungan()
    {
        $this->validate([
            'norm' => 'required',
            'nomorkartu' => 'required',
            'nik' => 'required|digits:16',
            'nama' => 'required',
            'nohp' => 'required',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'hakkelas' => 'required',
            'jenispeserta' => 'required',
            'kode' => 'required',
            'counter' => 'required',
            'tgl_transfer' => 'required',
            'penjamin' => 'required',
            'unit' => 'required',
            'bed' => 'required',
            'dokter' => 'required',
            'cara_masuk' => 'required',
            'jeniskunjungan' => 'required',
        ]);

        // update pasien
        $pasien = Pasien::firstWhere('norm', $this->norm);
        $pasien->update([
            'nomorkartu' => $this->nomorkartu,
            'nik' => $this->nik,
            'nama' => $this->nama,
            'nohp' => $this->nohp,
            'tgl_lahir' => $this->tgl_lahir,
            'gender' => $this->gender,
            'hakkelas' => $this->hakkelas,
            'jenispeserta' => $this->jenispeserta,
        ]);
        $kunjunganigd = $this->kunjungan;
        if (!empty($kunjunganigd->kode_transfer)) {
            $kodetf = $kunjunganigd->kode_transfer;
        } else {
            $kodetf = strtoupper(uniqid());
        }
        $unit = Unit::firstWhere('kode', $this->unit);
        $kamar = Kamar::firstWhere('unit_id', $unit->id);
        $bed = Bed::find($this->bed);
        $kunjunganranap = Kunjungan::updateOrCreate([
            'kode' => $kodetf,
            'counter' => $this->counter,
        ], [
            'tgl_masuk' => Carbon::parse($this->tgl_transfer),
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
            'kamar_id' => $kamar->id,
            'bed_id' => $bed->id,
            'jeniskunjungan' => $this->jeniskunjungan,
            'nomorreferensi' => $this->nomorreferensi,
            'sep' => $this->sep,
            'cara_masuk' => $this->cara_masuk,
            'status' => 1,
            'user1' => auth()->user()->id,
        ]);
        $kunjunganigd->update([
            'kode_transfer' => $kodetf,
            'tgl_pulang' => Carbon::parse($this->tgl_transfer),
            'status' => 2,
            'user1' => auth()->user()->id,
        ]);
        Alert::success('Success', 'Kunjungan berhasil ditransfer');
        flash('Kunjungan IGD berhasil ditransfer ke Rawat Inap', 'success');
        $url = route('pendaftaran.igd.proses') . "?kode=" . $kunjunganigd->kode;
        redirect()->to($url);
    }

    public function mount($kunjungan)
    {
        $this->kunjungan = $kunjungan;
        $this->kunjunganranap = Kunjungan::firstWhere('kode', $kunjungan->kode_transfer);
        if ($kunjungan) {
            $this->nomorkartu = $kunjungan->nomorkartu;
            $this->nik = $kunjungan->pasien?->nik;
            $this->nohp = $kunjungan->pasien?->nohp;
            $this->norm = $kunjungan->norm;
            $this->nama = $kunjungan->nama;
            $this->tgl_lahir = $kunjungan->tgl_lahir;
            $this->gender = $kunjungan->gender;
            $this->hakkelas = $kunjungan->kelas;
            $this->jenispeserta = $kunjungan->penjamin;
            $this->kode_transfer = $kunjungan->kode_transfer;
            $this->kode = $kunjungan->kode;
            $this->counter = $kunjungan->counter;
            // $this->tgl_masuk = $kunjungan->tgl_masuk;
            // $this->unit = $kunjungan->unit;
            $this->dokter = $kunjungan->dokter;
            $this->cara_masuk = $kunjungan->cara_masuk;
            // $this->jeniskunjungan = $kunjungan->jeniskunjungan;
            $this->penjamin = $kunjungan->jaminan;
            $this->nomorreferensi = $kunjungan->nomorreferensi;
            $this->sep = $kunjungan->sep;
        }
        if ($this->kunjunganranap) {
            $this->tgl_transfer = $this->kunjunganranap->tgl_masuk;
            $this->unit = $this->kunjunganranap->unit;
            if ($this->unit) {
                $this->beds = Bed::where('koderuang', $this->unit)->get();
            }
            $this->bed = $this->kunjunganranap->bed_id;
            $this->jeniskunjungan = $this->kunjunganranap->jeniskunjungan;
        }
        $this->jaminans = Jaminan::pluck('nama', 'kode');
        $this->units = Unit::where("jenis", "Pelayanan Rawat Inap")->pluck('nama', 'kode');
        $this->dokters = Dokter::pluck('nama', 'kode');
    }
    public function updatedUnit($value)
    {
        $this->beds = Bed::where('koderuang', $value)->get();
    }
    public function render()
    {
        return view('livewire.igd.modal-transfer-ranap');
    }
}
