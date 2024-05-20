<?php

namespace App\Livewire\Perawat;

use App\Models\Perawat;
use Livewire\Component;
use Livewire\WithPagination;

class PerawatIndex extends Component
{
    use WithPagination;
    public $search = '';
    public function render()
    {
        $search = '%' . $this->search . '%';
        $perawats = Perawat::where('nama', 'like', $search)->paginate();
        return view('livewire.perawat.perawat-index', compact('perawats'))->title('Perawat');
    }
}
