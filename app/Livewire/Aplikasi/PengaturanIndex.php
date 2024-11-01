<?php

namespace App\Livewire\Aplikasi;

use App\Models\Pengaturan;
use Livewire\Component;

class PengaturanIndex extends Component
{
    public $pengaturan;
    public $nama, $idorganization, $phone, $email, $website, $address, $postalCode, $province, $city, $district, $village;
    public function store()
    {
        $pengaturan = Pengaturan::first();
        if ($pengaturan) {
            $pengaturan->update([
                'nama' => $this->nama,
                'idorganization' => $this->idorganization,
                'phone' => $this->phone,
                'email' => $this->email,
                'website' => $this->website,
                'address' => $this->address,
                'postalCode' => $this->postalCode,
                'province' => $this->province,
                'city' => $this->city,
                'district' => $this->district,
                'village' => $this->village,
            ]);
        } else {
            $pengaturan =  Pengaturan::create([
                'nama' => $this->nama,
                'idorganization' => $this->idorganization,
                'phone' => $this->phone,
                'email' => $this->email,
                'website' => $this->website,
                'address' => $this->address,
                'postalCode' => $this->postalCode,
                'province' => $this->province,
                'city' => $this->city,
                'district' => $this->district,
                'village' => $this->village,
            ]);
        }
        flash('Data berhasil disimpan', 'success');
    }
    public function render()
    {
        $this->pengaturan = Pengaturan::first();
        if ($this->pengaturan) {
            $this->nama = $this->pengaturan->nama;
            $this->idorganization = $this->pengaturan->idorganization;
            $this->phone = $this->pengaturan->phone;
            $this->email = $this->pengaturan->email;
            $this->website = $this->pengaturan->website;
            $this->address = $this->pengaturan->address;
            $this->postalCode = $this->pengaturan->postalCode;
            $this->province = $this->pengaturan->province;
            $this->city = $this->pengaturan->city;
            $this->district = $this->pengaturan->district;
            $this->village = $this->pengaturan->village;
        }
        return view('livewire.aplikasi.pengaturan-index')->title('Pengaturan Aplikasi');
    }
}
