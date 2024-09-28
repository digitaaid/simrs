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
    public function render()
    {
        $this->provinsis = Provinsi::pluck('name', 'code');
        return view('livewire.admin.wilayah-indonesia')->title('Wilayah Indonesia');
    }
}
