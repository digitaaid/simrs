<?php

namespace App\Livewire\Jaminan;

use App\Exports\JaminanExport;
use App\Imports\JaminanImport;
use App\Models\Jaminan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class JaminanIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $jaminan;
    public $search = '';
    public $form = false;
    public $formImport = false;
    public $fileImport;
    public function mount()
    {
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $jaminans = Jaminan::where('nama', 'like', $search)->paginate();
        return view('livewire.jaminan.jaminan-index',compact('jaminans'))->title('Jaminan');
    }
    public function import()
    {
        try {
            $this->validate([
                'fileImport' => 'required|mimes:xlsx'
            ]);
            Excel::import(new JaminanImport, $this->fileImport->getRealPath());
            flash('Import Jaminan successfully', 'success');
            $this->formImport = false;
            $this->fileImport = null;
            return redirect()->route('jaminan.index');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');
            return Excel::download(new JaminanExport, 'jaminan_backup_' . $time . '.xlsx');
            flash('Export Pasien successfully', 'success');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function openFormImport()
    {
        $this->formImport =  $this->formImport ? false : true;
    }
    public function openForm()
    {
        $this->form = $this->form ? false : true;
    }
}
