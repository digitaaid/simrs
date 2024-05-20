<?php

namespace App\Livewire\Unit;

use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class UnitIndex extends Component
{
    use WithPagination;
    public $search = '';
    public function render()
    {
        $search = '%' . $this->search . '%';
        $units = Unit::where('nama', 'like', $search)->paginate();
        return view('livewire.unit.unit-index', compact('units'))->title('Unit');
    }
}
