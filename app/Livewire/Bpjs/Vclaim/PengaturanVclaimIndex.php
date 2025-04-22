<?php

namespace App\Livewire\Bpjs\Vclaim;

use App\Models\ActivityLog;
use App\Models\PengaturanVclaim;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PengaturanVclaimIndex extends Component
{
    public $pengaturan;
    public $id, $nama, $kode, $baseUrl, $authUrl, $userKey, $secretKey;
    public function render()
    {
        return view('livewire.bpjs.vclaim.pengaturan-vclaim-index')
            ->title('Pengaturan Vclaim BPJS');
    }
    public function save()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => 'required',
        ]);
        $user = Auth::user();
        $pengaturan = PengaturanVclaim::first();
        if (!$pengaturan) {
            $pengaturan = new PengaturanVclaim();
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
        flash('Pengaturan Vclaim updated successfully!', 'success');
    }
    public function mount()
    {
        $pengaturan = PengaturanVclaim::first();
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
