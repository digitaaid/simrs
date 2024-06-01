<?php

namespace App\Livewire\Pendaftaran;

use App\Http\Controllers\VclaimController;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Kabupaten;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;
use Laravolt\Indonesia\Models\Provinsi;
use Livewire\Component;
use Livewire\WithPagination;

class ModalPasienRajal extends Component
{
    use WithPagination;
    public $search = '';
    public $form = false;
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
        try {
            if ($this->id) {
                $pasien = Pasien::find($this->id);
            } else {
                $pasien = new Pasien();
                $pasiensebelumnya  = Pasien::orderBy('norm', 'desc')->first()?->norm;
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
            $pasien->user = auth()->user()->id;
            $pasien->pic = auth()->user()->name;
            $pasien->updated_at = now();
            $pasien->save();
            flash('Pasien ' . $pasien->nama . ' saved successfully', 'success');
            $this->form = false;
        } catch (\Throwable $th) {
            flash($th->getMessage(), 'danger');
        }
    }
    public function tambahPasien()
    {
        $this->form = $this->form ? false : true;
    }
    public function formPasien()
    {
        $this->dispatch('formPasien');
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
    public function render()
    {
        $search = '%' . $this->search . '%';
        $pasiens = Pasien::where('nama', 'like', $search)
            ->OrWhere('nik', 'like', $search)
            ->OrWhere('norm', 'like', $search)
            ->OrWhere('nomorkartu', 'like', $search)
            ->orderBy('norm', 'desc')
            ->paginate(10);
        return view('livewire.pendaftaran.modal-pasien-rajal', compact('pasiens'));
    }
}
