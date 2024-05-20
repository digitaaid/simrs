<?php

namespace App\Livewire\Pasien;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PasienIndex extends Component
{
    use WithPagination;
    public $search = '';
    public function mount()
    {
    }
    public function placeholder()
    {
        return view('components.placeholder.placeholder-text')->title('Pasien');
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $pasiens = Pasien::paginate();
        return view('livewire.pasien.pasien-index', compact('pasiens'))->title('Pasien');
    }
}
