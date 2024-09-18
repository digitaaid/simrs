<?php

namespace App\Livewire\Farmasi;

use App\Models\Kunjungan;
use App\Models\ResepObat;
use Livewire\Component;

class PengambilanObatIgd extends Component
{

    public $tanggal, $reseps, $resepantri;
    public $playAudio = true;
    public function mount()
    {
        $this->tanggal = now()->format('Y-m-d');
    }
    public function refreshComponent()
    {
        $this->resepantri =  $this->resepantri = ResepObat::where('status', 1)->first();
        if ($this->resepantri) {
            $this->playAudio = true;
            $this->dispatch('play-audio');
        } else {
            $this->playAudio = false;
        }
    }
    public function terimaResep($id)
    {
        $resep = ResepObat::find($id);
        $resep->status = 2;
        $resep->user = auth()->user()->id;
        $resep->pic = auth()->user()->name;
        $resep->update();
        flash('Resep obat atas nama pasien ' . $resep->nama . ' telah diterima farmasi.', 'success');
    }
    public function render()
    {
        if ($this->tanggal) {
            $this->reseps = ResepObat::orderBy('status', 'asc')->get();
        }
        return view('livewire.farmasi.pengambilan-obat-igd')->title('Pengambilan Obat IGD');
    }
}
