<?php

namespace App\Livewire\Admin;

use Laravolt\Indonesia\Models\Kabupaten;
use Laravolt\Indonesia\Models\Kecamatan;
use Laravolt\Indonesia\Models\Kelurahan;
use Laravolt\Indonesia\Models\Provinsi;
use Livewire\Component;

class WilayahIndonesia extends Component
{
    public $kabupatens = [], $provinsis = [], $kecamatans = [], $desas = [];
    public $desa_id, $kecamatan_id, $kabupaten_id, $provinsi_id;
    public $errorMessage = '';

    // Update Provinsi Data
    public function updatedProvinsiId()
    {
        $this->kabupatens = [];
        $this->kecamatans = [];
        $this->desas = [];
        $provinsi = Provinsi::where('name', 'like', '%' . $this->provinsi_id . '%')->first();

        if ($provinsi) {
            $this->provinsis = Provinsi::where('name', 'like', '%' . $this->provinsi_id . '%')->limit(20)->pluck('name', 'code');
            $this->errorMessage = '';
        } else {
            $this->provinsis = [];
            $this->errorMessage = 'Provinsi tidak ditemukan';
        }
    }

    // Update Kabupaten Data
    public function updatedKabupatenId()
    {
        $this->kecamatans = [];
        $this->desas = [];
        $provinsi = Provinsi::where('name', $this->provinsi_id)->first();

        if ($provinsi) {
            $kabupaten = Kabupaten::where('province_code', $provinsi->code)
                ->where('name', 'like', '%' . $this->kabupaten_id . '%')
                ->first();

            if ($kabupaten) {
                $this->kabupatens = Kabupaten::where('province_code', $provinsi->code)
                    ->where('name', 'like', '%' . $this->kabupaten_id . '%')
                    ->limit(20)
                    ->pluck('name', 'code');
                $this->errorMessage = '';
            } else {
                $this->kabupatens = [];
                $this->errorMessage = 'Kabupaten tidak ditemukan';
            }
        } else {
            $this->kabupatens = [];
            $this->errorMessage = 'Provinsi belum dipilih dengan benar';
        }
    }

    // Update Kecamatan Data
    public function updatedKecamatanId()
    {
        $this->desas = [];
        $kabupaten = Kabupaten::where('name', $this->kabupaten_id)->first();

        if ($kabupaten) {
            $kecamatan = Kecamatan::where('city_code', $kabupaten->code)
                ->where('name', 'like', '%' . $this->kecamatan_id . '%')
                ->first();

            if ($kecamatan) {
                $this->kecamatans = Kecamatan::where('city_code', $kabupaten->code)
                    ->where('name', 'like', '%' . $this->kecamatan_id . '%')
                    ->limit(20)
                    ->pluck('name', 'code');
                $this->errorMessage = '';
            } else {
                $this->kecamatans = [];
                $this->errorMessage = 'Kecamatan tidak ditemukan';
            }
        } else {
            $this->kecamatans = [];
            $this->errorMessage = 'Kabupaten belum dipilih dengan benar';
        }
    }

    // Update Desa Data
    public function updatedDesaId()
    {
        $kecamatan = Kecamatan::where('name', $this->kecamatan_id)->first();

        if ($kecamatan) {
            $desa = Kelurahan::where('district_code', $kecamatan->code)
                ->where('name', 'like', '%' . $this->desa_id . '%')
                ->first();

            if ($desa) {
                $this->desas = Kelurahan::where('district_code', $kecamatan->code)
                    ->where('name', 'like', '%' . $this->desa_id . '%')
                    ->limit(20)
                    ->pluck('name', 'code');
                $this->errorMessage = '';
            } else {
                $this->desas = [];
                $this->errorMessage = 'Desa tidak ditemukan';
            }
        } else {
            $this->desas = [];
            $this->errorMessage = 'Kecamatan belum dipilih dengan benar';
        }
    }

    public function render()
    {
        // Populate Provinsi by default
        $this->provinsis = Provinsi::pluck('name', 'code');

        return view('livewire.admin.wilayah-indonesia', [
            'errorMessage' => $this->errorMessage,
        ])->title('Wilayah Indonesia');
    }
}
