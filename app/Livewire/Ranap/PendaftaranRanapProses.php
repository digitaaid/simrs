<?php

namespace App\Livewire\Ranap;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftaranRanapProses extends Component
{
    public $kunjungan;
    protected $listeners = ['refreshPage' => '$refresh'];
    public function render()
    {
        if ($this->kunjungan) {
            $title = "Rawat Inap " . $this->kunjungan->nama;
        } else {
            $title = "Pendaftaran Pasien Rawat Inap";
        }
        return view('livewire.ranap.pendaftaran-ranap-proses')->title($title);
    }
    public function mount(Request $request)
    {
        $this->kunjungan = Kunjungan::where('kode', $request->kode)->first();
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
        return redirect()->to(route('pendaftaran.ranap') . "?tanggalperiksa=" . $kunjungan->tgl_masuk);
    }
}
