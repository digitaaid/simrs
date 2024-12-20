<?php

namespace App\Livewire\Ranap;

use App\Http\Controllers\VclaimController;
use App\Models\Bed;
use App\Models\Dokter;
use App\Models\Jaminan;
use App\Models\Kamar;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ModalKunjunganRanap extends Component
{
    public $kunjungan;
    public $jaminans, $units, $dokters, $beds = [];
    public $norm, $nohp, $nomorkartu, $nama, $bed, $nik, $tgl_lahir, $jenispeserta, $fktp, $hakkelas, $gender;
    public $kode, $counter, $tgl_masuk, $unit, $dokter, $cara_masuk, $jeniskunjungan, $penjamin, $nomorreferensi, $sep;
    public function render()
    {
        return view('livewire.ranap.modal-kunjungan-ranap');
    }
    public function mount($kunjungan)
    {
        $this->kunjungan = $kunjungan;
        if ($kunjungan) {
            $this->beds = Bed::where('koderuang', $kunjungan->unit)->get();
            $this->bed = $kunjungan->bed_id;
            $this->nomorkartu = $kunjungan->nomorkartu;
            $this->nik = $kunjungan->pasien?->nik;
            $this->nohp = $kunjungan->pasien?->nohp;
            $this->norm = $kunjungan->norm;
            $this->nama = $kunjungan->nama;
            $this->tgl_lahir = $kunjungan->tgl_lahir;
            $this->gender = $kunjungan->gender;
            $this->hakkelas = $kunjungan->kelas;
            $this->jenispeserta = $kunjungan->penjamin;
            $this->kode = $kunjungan->kode;
            $this->counter = $kunjungan->counter;
            $this->tgl_masuk = $kunjungan->tgl_masuk;
            $this->unit = $kunjungan->unit;
            $this->dokter = $kunjungan->dokter;
            $this->cara_masuk = $kunjungan->cara_masuk;
            $this->jeniskunjungan = $kunjungan->jeniskunjungan;
            $this->penjamin = $kunjungan->jaminan;
            $this->nomorreferensi = $kunjungan->nomorreferensi;
            $this->sep = $kunjungan->sep;
        }
        $this->jaminans = Jaminan::pluck('nama', 'kode');
        $this->units = Unit::where("jenis", "Pelayanan Rawat Inap")->pluck('nama', 'kode');
        $this->dokters = Dokter::where('status', 1)->pluck('nama', 'kode');
    }
    public function updatedUnit($value)
    {
        $this->beds = Bed::where('koderuang', $value)->get();
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
            $this->nohp = $pasien->nohp;
            $this->hakkelas = $pasien->hakkelas;
            $this->tgl_lahir = $pasien->tgl_lahir;
            $this->gender = $pasien->gender;
            $this->jenispeserta = $pasien->jenispeserta;
        }
    }
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
            'tgl_masuk' => 'required',
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
        if (!$this->kode) {
            $this->kode = strtoupper(uniqid());
            $kunjunganaktif = Kunjungan::where('norm', $this->norm)
                ->where('status', 1)
                ->first();
            if ($kunjunganaktif) {
                return flash('Pasien atas nama ' . $kunjunganaktif->nama . ' masih memiliki kunjungan aktif ke ' . $kunjunganaktif->units->nama, 'danger');
            }
        }
        if (!$this->counter) {
            $this->counter = Kunjungan::where('norm', $this->norm)->count() + 1  ?? 1;
        }
        $unit = Unit::firstWhere('kode', $this->unit);
        $kamar = Kamar::firstWhere('unit_id', $unit->id);
        $bed = Bed::find($this->bed);
        $kunjunganranap = Kunjungan::updateOrCreate(
            [
                'kode' => $this->kode,
                'counter' => $this->counter,
            ],
            [
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
                'kamar_id' => $kamar->id,
                'bed_id' => $bed->id,
                'jeniskunjungan' => $this->jeniskunjungan,
                'nomorreferensi' => $this->nomorreferensi,
                'sep' => $this->sep,
                'cara_masuk' => $this->cara_masuk,
                'status' => 1,
                'user1' => auth()->user()->id,
            ]
        );
        Alert::success('Success', 'Kunjungan Rawat Inap berhasil disimpan');
        flash('Kunjungan Rawat Inap Berhasil Disimpan', 'success');
        $url = route('pendaftaran.ranap.proses') . "?kode=" . $kunjunganranap->kode;
        redirect()->to($url);
    }
}
