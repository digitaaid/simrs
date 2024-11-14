<?php

namespace App\Livewire\Aplikasi;

use App\Models\Pengaturan;
use Livewire\Component;
use Livewire\WithFileUploads;

class PengaturanIndex extends Component
{
    use WithFileUploads;
    public $pengaturan;
    public $nama, $idorganization, $phone, $email, $website, $address, $postalCode, $province, $city, $district, $village;
    public $logo_icon, $logo_background, $logo_no_background;
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
            $this->logo_icon = $this->pengaturan->logo_icon;
            $this->logo_background = $this->pengaturan->logo_background;
            $this->logo_no_background = $this->pengaturan->logo_no_background;
        }
        return view('livewire.aplikasi.pengaturan-index')->title('Pengaturan Aplikasi');
    }
    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'logo_icon' => 'required',
            'logo_background' => 'required',
            'logo_no_background' => 'required',
        ]);
        if ($this->logo_icon) {
            $logo_icon =  'logo_icon.' . $this->logo_icon->getClientOriginalExtension();
            $path =  $this->logo_icon->storeAs('public/pengaturan',  $logo_icon);
            $this->logo_icon =  $logo_icon;
        }
        if ($this->logo_background) {
            $logo_background =  'logo_background.' . $this->logo_background->getClientOriginalExtension();
            $path =  $this->logo_background->storeAs('public/pengaturan',  $logo_background);
            $this->logo_background =  $logo_background;
        }
        if ($this->logo_no_background) {
            $logo_no_background =  'logo_no_background.' . $this->logo_no_background->getClientOriginalExtension();
            $path =  $this->logo_no_background->storeAs('public/pengaturan',  $logo_no_background);
            $this->logo_no_background =  $logo_no_background;
        }
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
                'logo_icon' => $this->logo_icon,
                'logo_background' => $this->logo_background,
                'logo_no_background' => $this->logo_no_background,
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
}
