<?php

namespace App\Livewire\Kamarbed;

use App\Models\Bed;
use App\Models\Kamar;
use Livewire\Component;

class BedIndex extends Component
{
    public $form = 0;
    public $kamars, $beds;
    public $bed, $id, $kamar_id, $nomorbed, $bedpria, $bedwanita, $status;
    public function store()
    {
        $kamar = Kamar::find($this->kamar_id);
        $bed = Bed::updateOrCreate(
            [
                'id' => $this->id,
            ],
            [
                'nomorbed' => $this->nomorbed,
                'koderuang' => $kamar->koderuang,
                'namaruang' => $kamar->namaruang,
                'unit_id' => $kamar->unit_id,
                'kamar_id' => $kamar->id,
                'bedpria' => $this->bedpria ?? 1,
                'bedwanita' => $this->bedwanita ?? 1,
                'status' => 0,
                'user' => auth()->user()->id,
                'pic' => auth()->user()->name,
            ]
        );
        $this->form = 0;
        flash('Berhasil simpan data bed', 'success');
    }
    public function edit(Bed $bed)
    {
        $this->id = $bed->id;
        $this->kamar_id = $bed->kamar_id;
        $this->nomorbed = $bed->nomorbed;
        $this->bedpria = $bed->bedpria;
        $this->bedwanita = $bed->bedwanita;
        $this->status = $bed->status;
        $this->form = 1;
    }

    public function tambah()
    {
        $this->form = $this->form ? 0 : 1;
        $this->reset(['bed', 'id', 'kamar_id', 'nomorbed', 'bedpria', 'bedwanita', 'status']);
    }
    public function mount()
    {
        $this->kamars = Kamar::get();
    }
    public function render()
    {
        $this->beds = Bed::get();
        return view('livewire.kamarbed.bed-index');
    }
}
