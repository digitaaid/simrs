<?php

namespace App\Livewire\Igd;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftaranIgdProses extends Component
{
    public $kunjungan;
    protected $listeners = ['refreshPage' => '$refresh'];
    public function render()
    {
        return view('livewire.igd.pendaftaran-igd-proses')->title('Pendaftaran IGD');
    }
    public function mount($kodebooking)
    {
        $this->kunjungan = Kunjungan::where('kode', $kodebooking)->first();
    }
    public function batal()
    {
        $kunjungan = $this->kunjungan;
        if ($kunjungan) {
            $kunjungan->update([
                'status' => 99,
                'user1' => auth()->user()->id,
            ]);
        }
        Alert::success('Success', 'Kunjungan Pasien ' . $kunjungan->nama . ' telah dibatalakan pendaftaran.');
        return redirect()->to(route('pendaftaran.igd') . "?tanggalperiksa=" . $kunjungan->tgl_masuk);
    }
}
