<?php

namespace App\Livewire\Pasien;

use App\Exports\PasienExport;
use App\Http\Controllers\PatientController;
use App\Imports\PasienImport;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
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
    public function render()
    {
        $search = '%' . $this->search . '%';
        $pasiens = Pasien::where('nama', 'like', $search)
            ->OrWhere('nik', 'like', $search)
            ->OrWhere('norm', 'like', $search)
            ->OrWhere('nomorkartu', 'like', $search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate();
        return view('livewire.pasien.pasien-index', compact('pasiens'))->title('Pasien');
    }
    public function import()
    {
        try {
            $this->validate([
                'filePasienImport' => 'required|mimes:xlsx'
            ]);
            Excel::import(new PasienImport, $this->filePasienImport->getRealPath());
            flash('Import Pasien successfully', 'success');
            $this->formImport = false;
            $this->filePasienImport = null;
            return redirect()->to('/pasien');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');
            return Excel::download(new PasienExport, 'pasien_backup_' . $time . '.xlsx');
            flash('Export Pasien successfully', 'success');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    function openFormImport()
    {
        $this->formImport = true;
    }
    function closeFormImport()
    {
        $this->formImport = false;
        $this->filePasienImport = null;
    }
    public $sortBy = 'norm';
    public $sortDirection = 'desc';
    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $field;
    }
    public function placeholder()
    {
        return view('components.placeholder.placeholder-text');
    }
    public function getPatientId($nik)
    {
        $api = new PatientController();
        $request = new Request([
            'nik' => $nik
        ]);
        $res = $api->get_patient_id($request);
        if ($res->metadata->code == 200) {
            flash('Get Patien ID successfully', 'success');
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
}
