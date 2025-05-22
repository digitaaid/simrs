<?php

namespace App\Livewire\Bpjs\Antrian;

use App\Models\ActivityLog;
use App\Models\PengaturanAntrian;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PengaturanAntrianIndex extends Component
{
    public $pengaturan;
    public $id, $nama, $kode, $baseUrl, $authUrl, $userKey, $secretKey;
    public $syncron_antrian = false; // Tambahkan ini

    public function syncAntrian()
    {
        $this->syncron_antrian = !$this->syncron_antrian;
        $pengaturan = PengaturanAntrian::first();
        if ($pengaturan) {
            $pengaturan->syncron_antrian = $this->syncron_antrian;
            $pengaturan->save();
        }
        flash('Status syncron antrian diubah!', 'success');
    }
    public function render()
    {
        return view('livewire.bpjs.antrian.pengaturan-antrian-index')
            ->title('Pengaturan Antrian BPJS');
    }
    public function save()
    {
        $user = Auth::user();
        $pengaturan = PengaturanAntrian::first();
        if (!$pengaturan) {
            $pengaturan = new PengaturanAntrian();
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
        $pengaturan = PengaturanAntrian::first();
        if ($pengaturan) {
            $this->pengaturan = $pengaturan;
            $this->nama = $pengaturan->nama;
            $this->kode = $pengaturan->kode;
            $this->baseUrl = $pengaturan->baseUrl;
            $this->authUrl = $pengaturan->authUrl;
            $this->userKey = $pengaturan->userKey;
            $this->secretKey = $pengaturan->secretKey;
            $this->syncron_antrian = $pengaturan->syncron_antrian ?? false; // Ambil dari DB jika ada
        }
    }
}
