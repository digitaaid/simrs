<?php

namespace App\Livewire\Kamarbed;

use App\Models\Kamar;
use App\Models\Unit;
use Livewire\Component;

class KamarIndex extends Component
{
    public $form = 0;
    public $units, $kamars;
    public $id, $unit_id, $koderuang, $nama, $kodekelas, $kapasitastotal, $kapasitaspria, $kapasitaswanita, $kapasitaspriawanita;
    public function store()
    {
        $unit = Unit::find($this->unit_id);
        $kamar = Kamar::updateOrCreate(
            [
                'unit_id' => $unit->id,
                'koderuang' => $unit->kode,
            ],
            [
                'namaruang' => $unit->nama,
                'kodekelas' => $this->kodekelas,
                'kapasitastotal' => $this->kapasitastotal ?? 0,
                'kapasitaspria' => $this->kapasitaspria ?? 0,
                'kapasitaswanita' => $this->kapasitaswanita ?? 0,
                'kapasitaspriawanita' => $this->kapasitaspriawanita ?? 0,
                'status' => 1,
                'user' => auth()->user()->id,
                'pic' => auth()->user()->name,
            ]
        );
        $this->form = 0;
        flash('Berhasil simpan data kamar', 'success');
    }
    public function edit(Kamar $kamar)
    {
        $this->form = 1;
        $this->id = $kamar->id;
        $this->unit_id = $kamar->unit_id;
        $this->kodekelas = $kamar->kodekelas;
        $this->kapasitastotal = $kamar->kapasitastotal;
        $this->kapasitaspria = $kamar->kapasitaspria;
        $this->kapasitaswanita = $kamar->kapasitaswanita;
        $this->kapasitaspriawanita = $kamar->kapasitaspriawanita;
    }
    public function tambah()
    {
        $this->form = $this->form ? 0 : 1;
    }
    public function mount()
    {
        $this->units = Unit::where('jenis', 'Pelayanan Rawat Inap')->get();
    }
    public function render()
    {
        $this->kamars = Kamar::get();

        return view('livewire.kamarbed.kamar-index');
    }
}
