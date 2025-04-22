<?php

namespace App\Livewire\Aplikasi;

use App\Models\Pengaturan;
use Livewire\Component;
use Livewire\WithFileUploads;

class PengaturanIndex extends Component
{
    use WithFileUploads;
    public $pengaturan;
    public $nama;
    public $logo_icon, $auth_img;
    public function mount()
    {
        $this->pengaturan = Pengaturan::first();
        if ($this->pengaturan) {
            $this->nama = $this->pengaturan->nama;
            $this->logo_icon = $this->pengaturan->logo_icon;
            $this->auth_img = $this->pengaturan->auth_img;
        }
    }
    public function render()
    {
        return view('livewire.aplikasi.pengaturan-index')->title('Pengaturan Aplikasi');
    }
    public function store()
    {
        $this->validate([
            'nama' => 'required',
        ]);
        if (is_file($this->logo_icon)) {
            $logo_icon =  'logo_icon.' . $this->logo_icon->getClientOriginalExtension();
            $path =  $this->logo_icon->storeAs('public/pengaturan',  $logo_icon);
            $this->logo_icon =  $logo_icon;
        }
        if (is_file($this->auth_img)) {
            $auth_img =  'auth_img.' . $this->auth_img->getClientOriginalExtension();
            $path =  $this->auth_img->storeAs('public/pengaturan',  $auth_img);
            $this->auth_img =  $auth_img;
        }
        $pengaturan = Pengaturan::first();
        if ($pengaturan) {
            $pengaturan->update([
                'nama' => $this->nama,
                'logo_icon' => $this->logo_icon,
                'auth_img' => $this->auth_img,
            ]);
        } else {
            $pengaturan =  Pengaturan::create([
                'nama' => $this->nama,
                'logo_icon' => $this->logo_icon,
                'auth_img' => $this->auth_img,
            ]);
        }
        flash('Data berhasil disimpan', 'success');
    }
}
