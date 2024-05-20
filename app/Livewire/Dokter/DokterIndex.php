<?php

namespace App\Livewire\Dokter;

use App\Models\Dokter;
use Livewire\Component;
use Livewire\WithPagination;

class DokterIndex extends Component
{
    use WithPagination;
    public $search = '';
    public function render()
    {
        $search = '%' . $this->search . '%';
        $dokters = Dokter::where('nama', 'like', $search)->paginate();
        return view('livewire.dokter.dokter-index', compact('dokters'))->title('Dokter');
    }
}
