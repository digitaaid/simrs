<?php

namespace App\Livewire\Dokter;

use App\Exports\DokterExport;
use App\Http\Controllers\PractitionerController;
use App\Http\Controllers\SatuSehatController;
use App\Imports\DokterImport;
use App\Models\Dokter;
use App\Models\Integration;
use App\Models\PengaturanSatuSehat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class DokterIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $search = '';
    public $form = false;
    public $formImport = false;
    public $id, $nama, $kode, $kodejkn, $nik, $user_id, $idpractitioner, $title, $gender, $sip, $image, $status, $user, $pic;
    public $fileImport;
    public $dokter;
    public function render()
    {
        $search = '%' . $this->search . '%';
        $dokters = Dokter::where('nama', 'like', $search)->paginate();
        return view('livewire.dokter.dokter-index', compact('dokters'))->title('Dokter');
    }
    public function cariIdPractitioner($nik)
    {
        $res = $this->practitioner_by_nik($nik);
        $dokter = Dokter::where('nik', $nik)->first();
        if (count($res->response->entry)) {
            $id = $res->response->entry[0]->resource->id;
            $dokter->update([
                'idpractitioner' => $id
            ]);
            flash('Data Dokter sudah disinkronkan satusehat', 'success');
        } else {
            flash('Data Dokter tidak ditemukan di satusehat', 'danger');
        }
    }
    public function practitioner_by_nik($nik)
    {
        $token = Cache::get('satusehat_access_token');
        $api = PengaturanSatuSehat::first();
        $url = $api->baseUrl . "/Practitioner?identifier=https://fhir.kemkes.go.id/id/nik|" . $nik;
        $response = Http::withToken($token)->get($url);
        $data = $response->json();
        $api = new SatuSehatController();
        return $api->responseSatuSehat($data);
    }
    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => 'required',
        ]);
        if ($this->dokter) {
            $dokter = $this->dokter;
        } else {
            $dokter = new Dokter();
        }
        $dokter->kode = $this->kode;
        $dokter->nama = $this->nama;
        $dokter->kodejkn = $this->kodejkn;
        $dokter->nik = $this->nik;
        $dokter->idpractitioner = $this->idpractitioner;
        $dokter->title = $this->title;
        $dokter->gender = $this->gender;
        $dokter->sip = $this->sip;
        $dokter->user = auth()->user()->id;
        $dokter->pic = auth()->user()->name;
        $dokter->save();
        $this->resetForm();
        $this->openForm();
        flash('Dokter ' . $dokter->name . ' saved successfully', 'success');
    }
    public function edit(Dokter $dokter)
    {
        $this->dokter = $dokter;
        $this->id = $dokter->id;
        $this->nama = $dokter->nama;
        $this->kode = $dokter->kode;
        $this->kodejkn = $dokter->kodejkn;
        $this->nik = $dokter->nik;
        $this->user_id = $dokter->user_id;
        $this->idpractitioner = $dokter->idpractitioner;
        $this->title = $dokter->title;
        $this->gender = $dokter->gender;
        $this->sip = $dokter->sip;
        $this->status = $dokter->status;
        $this->openForm();
    }
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        flash('Dokter ' . $dokter->name . ' deleted successfully', 'success');
    }
    public function nonaktif(Dokter $dokter)
    {
        $status = $dokter->status ? 0 : 1;
        $dokter->status =  $status;
        $dokter->save();
        flash('Dokter ' . $dokter->name . ' noncactive successfully', 'success');
    }
    public function resetForm()
    {
        $this->dokter = null;
        $this->id = null;
        $this->nama = null;
        $this->kode = null;
        $this->kodejkn = null;
        $this->nik = null;
        $this->user_id = null;
        $this->idpractitioner = null;
        $this->title = null;
        $this->gender = null;
        $this->sip = null;
        $this->image = null;
    }
    public function import()
    {
        try {
            $this->validate([
                'fileImport' => 'required|mimes:xlsx'
            ]);
            Excel::import(new DokterImport, $this->fileImport->getRealPath());
            flash('Import Dokter successfully', 'success');
            $this->formImport = false;
            $this->fileImport = null;
            return redirect()->route('dokter.index');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');
            return Excel::download(new DokterExport, 'dokter_backup_' . $time . '.xlsx');
            flash('Export Dokter successfully', 'success');
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
        $this->form =  $this->form ? false : true;
    }
    public function getPractitionerId($nik)
    {
        $api = new PractitionerController();
        $request = new Request([
            'nik' => $nik
        ]);
        $res = $api->get_practitioner_id($request);
        if ($res->metadata->code == 200) {
            flash('Get ID successfully', 'success');
        } else {
            flash($res->metadata->message, 'danger');
        }
    }
}
