<?php

namespace App\Livewire\Pasien;

use App\Http\Controllers\VclaimController;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravolt\Indonesia\Models\Kabupaten;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;
use Laravolt\Indonesia\Models\Provinsi;
use Livewire\Component;

class PasienForm extends Component
{
    public $id, $norm, $nama, $nomorkartu, $nik, $idpatient, $nohp, $gender, $tempat_lahir, $tgl_lahir, $hakkelas, $jenispeserta, $fktp, $desa_id, $kecamatan_id, $kabupaten_id, $provinsi_id, $alamat, $status = 1, $keterangan;
    public $kabupatens = [], $provinsis = [], $kecamatans = [], $desas = [];
    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'nohp' => 'required',
            'alamat' => 'required',
            'gender' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',

        ]);
        if ($this->id) {
            $pasien = Pasien::find($this->id);
        } else {
            $pasien = new Pasien();
            $pasiensebelumnya  = Pasien::latest()->first()?->norm;
            if ($pasiensebelumnya) {
                $norm = sprintf("%06d", $pasiensebelumnya + 1);
            } else {
                $norm = "000001";
            }
            $pasien->norm =  $norm;
        }
        $pasien->nomorkartu = $this->nomorkartu;
        $pasien->nik = $this->nik;
        $pasien->idpatient = $this->idpatient;
        $pasien->nama = $this->nama;
        $pasien->nohp = $this->nohp;
        $pasien->gender = $this->gender;
        $pasien->tempat_lahir = $this->tempat_lahir;
        $pasien->tgl_lahir = $this->tgl_lahir;
        $pasien->hakkelas = $this->hakkelas;
        $pasien->jenispeserta = $this->jenispeserta;
        $pasien->fktp = $this->fktp;
        $pasien->desa_id = $this->desa_id;
        $pasien->kecamatan_id = $this->kecamatan_id;
        $pasien->kabupaten_id = $this->kabupaten_id;
        $pasien->provinsi_id = $this->provinsi_id;
        $pasien->alamat = $this->alamat;
        $pasien->status = 1;
        $pasien->keterangan = $this->keterangan;
        $pasien->user = Auth::user()->id;
        $pasien->pic = Auth::user()->name;
        $pasien->updated_at = now();
        $pasien->save();
        flash('Pasien ' . $pasien->name . ' saved successfully', 'success');
        return redirect()->to('/pasien');
    }
    public function updatedTempatLahir()
    {
        $this->kabupatens = [];
        $this->kabupatens = Kabupaten::where('name', 'like', '%' . $this->tempat_lahir . '%')->limit(20)->pluck('name', 'code');
    }
    public function updatedProvinsiId()
    {
        $this->provinsis = [];
        $this->provinsis = Provinsi::where('name', 'like', '%' . $this->provinsi_id . '%')->limit(20)->pluck('name', 'code');
    }
    public function updatedKabupatenId()
    {
        $this->kabupatens = [];
        $provinsi = Provinsi::where('name', $this->provinsi_id)->first();
        $this->kabupatens = Kabupaten::where('province_code', $provinsi->code)->where('name', 'like', '%' . $this->kabupaten_id . '%')->limit(20)->pluck('name', 'code');
    }
    public function updatedKecamatanId()
    {
        $this->kecamatans = [];
        $kabupaten = Kabupaten::where('name', $this->kabupaten_id)->first();
        $this->kecamatans = Kecamatan::where('city_code', $kabupaten->code)->where('name', 'like', '%' . $this->kecamatan_id . '%')->limit(20)->pluck('name', 'code');
    }
    public function updatedDesaId()
    {
        $this->desas = [];
        $kecamatan = Kecamatan::where('name', $this->kecamatan_id)->first();
        $this->desas = Kelurahan::where('district_code', $kecamatan->code)->where('name', 'like', '%' . $this->desa_id . '%')->limit(20)->pluck('name', 'code');
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
    public function mount()
    {
        $pasien = Pasien::firstWhere('norm', $this->norm);
        if ($pasien) {
            $this->id = $pasien->id;
            $this->nama = $pasien->nama;
            $this->nomorkartu = $pasien->nomorkartu;
            $this->nik = $pasien->nik;
            $this->idpatient = $pasien->idpatient;
            $this->nohp = $pasien->nohp;
            $this->gender = $pasien->gender;
            $this->tempat_lahir = $pasien->tempat_lahir;
            $this->tgl_lahir = $pasien->tgl_lahir;
            $this->hakkelas = $pasien->hakkelas;
            $this->jenispeserta = $pasien->jenispeserta;
            $this->fktp = $pasien->fktp;
            $this->desa_id = $pasien->desa_id;
            $this->kecamatan_id = $pasien->kecamatan_id;
            $this->kabupaten_id = $pasien->kabupaten_id;
            $this->provinsi_id = $pasien->provinsi_id;
            $this->alamat = $pasien->alamat;
            $this->status = $pasien->status;
            $this->keterangan = $pasien->keterangan;
        }
    }
    public function render()
    {
        $pasien = Pasien::firstWhere('norm', $this->norm);
        return view('livewire.pasien.pasien-form')->title('Pasien ' . $pasien->nama);
    }
}
