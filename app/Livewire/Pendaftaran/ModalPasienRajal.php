<?php

namespace App\Livewire\Pendaftaran;

use App\Models\Pasien;
use Livewire\Component;
use Livewire\WithPagination;

class ModalPasienRajal extends Component
{
    use WithPagination;
    public $search = '';
    public function formPasien()
    {
        $this->dispatch('formPasien');
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $pasiens = Pasien::where('nama', 'like', $search)
            ->OrWhere('nik', 'like', $search)
            ->OrWhere('norm', 'like', $search)
            ->OrWhere('nomorkartu', 'like', $search)
            ->orderBy('norm', 'desc')
            ->paginate(10);
        return view('livewire.pendaftaran.modal-pasien-rajal', compact('pasiens'));
    }
}
