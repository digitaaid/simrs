<?php

namespace App\Livewire\Satusehat;

use App\Http\Controllers\SatuSehatController;
use App\Imports\PasienImport;
use App\Models\Integration;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Excel;

class PatientIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';
    public $formImport = false;
    public $filePasienImport;
    public function patient_by_nik(Request $request)
    {
        $token = Cache::get('satusehat_access_token');
        $api = Integration::where('name', 'Satu Sehat')->first();
        $url = $api->base_url . "/Patient?identifier=https://fhir.kemkes.go.id/id/nik|9104025209000006";
        $response = Http::withToken($token)->get($url);
        $data =  $response->json();
        // satusehat
        $api = new SatuSehatController();
        return $api->responseSatuSehat($data);
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

    public function render()
    {
        $search = '%' . $this->search . '%';
        $pasiens = Pasien::where('nama', 'like', $search)
            ->OrWhere('nik', 'like', $search)
            ->OrWhere('norm', 'like', $search)
            ->OrWhere('nomorkartu', 'like', $search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate();
        return view('livewire.satusehat.patient-index', compact('pasiens'))->title('Patient');
    }
}
