<?php

namespace App\Livewire\Satusehat;

use App\Models\ActivityLog;
use App\Models\PengaturanSatuSehat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PengaturanSatusehatIndex extends Component
{
    public $pengaturan;
    public $id, $nama, $kode, $baseUrl, $authUrl, $userKey, $secretKey;
    public function render()
    {
        return view('livewire.satusehat.pengaturan-satusehat-index')
            ->title('Pengaturan Satu Sehat');
    }
    public function save()
    {
        $user = Auth::user();
        $pengaturan = PengaturanSatuSehat::first();
        if (!$pengaturan) {
            $pengaturan = new PengaturanSatuSehat();
        }
        $pengaturan->nama = $this->nama;
        $pengaturan->kode = $this->kode;
        $pengaturan->baseUrl = $this->baseUrl;
        $pengaturan->authUrl = $this->authUrl;
        $pengaturan->userKey = $this->userKey;
        $pengaturan->secretKey = $this->secretKey;
        $pengaturan->save();
        ActivityLog::create([
            'user_id' => $user->id,
            'activity' => 'Update Pengaturan Vclaim',
            'description' => 'User ' . $user->name . ' telah memperbaharui pengaturan vclaim',
        ]);
        flash('Pengaturan Antrian updated successfully!', 'success');
    }
    public function mount()
    {
        $pengaturan = PengaturanSatuSehat::first();
        if ($pengaturan) {
            $this->pengaturan = $pengaturan;
            $this->nama = $pengaturan->nama;
            $this->kode = $pengaturan->kode;
            $this->baseUrl = $pengaturan->baseUrl;
            $this->authUrl = $pengaturan->authUrl;
            $this->userKey = $pengaturan->userKey;
            $this->secretKey = $pengaturan->secretKey;
        }
    }
}
