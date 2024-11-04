<?php

namespace App\Livewire\Satusehat;

use App\Models\Kunjungan;
use Livewire\Component;

class EncounterEdit extends Component
{
    public $idencounter, $kunjungan;
    public function render()
    {
        return view('livewire.satusehat.encounter-edit')->title('Encounter');
    }
    public function mount($idencounter)
    {
        $this->kunjungan = Kunjungan::firstWhere('idencounter', $idencounter);
    }
}
