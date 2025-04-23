<?php

namespace App\Livewire\Jaminan;

use App\Models\Jaminan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class JaminanIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $jaminan;
    public $search = '';
    public $form = false;
    public $formImport = false;
    public $fileTindakanImport;
    public function mount()
    {
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $jaminans = Jaminan::where('nama', 'like', $search)->paginate();
        return view('livewire.jaminan.jaminan-index',compact('jaminans'))->title('Jaminan');
    }
}
