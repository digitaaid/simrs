<?php

namespace App\Livewire\Pasien;

use App\Exports\PasienExport;
use App\Imports\PasienImport;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PasienIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';
    public $formImport = false;
    public $filePasienImport;

    public function import()
    {
        // $this->validate([
        //     'filePasienImport' => 'required|file',
        // ]);
        set_time_limit(300);
        $excel =  Excel::import(new PasienImport, $this->filePasienImport);
        dd($excel);
        session()->flash('message', 'File uploaded successfully.');
    }

    public function export()
    {
        $time = now()->format('Y-m-d');
        return Excel::download(new PasienExport, 'pasien_backup_' . $time . '.xlsx');
    }
    function openFormImport()
    {
        $this->formImport = true;
    }
    function closeFormImport()
    {
        $this->formImport = false;
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $pasiens = Pasien::where('nama', 'like', $search)
            ->OrWhere('nik', 'like', $search)
            ->OrWhere('norm', 'like', $search)
            ->OrWhere('nomorkartu', 'like', $search)
            ->paginate();
        return view('livewire.pasien.pasien-index', compact('pasiens'))->title('Pasien');
    }
}
