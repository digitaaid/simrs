<?php

namespace App\Livewire\Pasien;

use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PasienForm extends Component
{
    public $id, $norm, $nama, $nomorkartu, $nik, $idpatient,  $nohp, $gender, $tempat_lahir, $tgl_lahir, $hakkelas, $jenispeserta, $fktp, $desa_id, $kecamatan_id, $kabupaten_id, $provinsi_id, $alamat, $status = 1, $keterangan;
    public function store()
    {
        if ($this->id) {
            $pasien = Pasien::find($this->id);
        } else {
            $pasien = new Pasien();
        }
        $pasien->norm = $this->norm;
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
        flash('Pasien saved successfully', 'success');
        return redirect()->to('/pasien');
    }
    public function render()
    {
        if ($this->norm) {
            $pasien = Pasien::firstWhere('norm', $this->norm);
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
        } else {
            $this->tgl_lahir = now()->format('Y-m-d');
        }
        return view('livewire.pasien.pasien-form')->title('Pasien ' . $this->nama);
    }
}
