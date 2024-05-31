<?php

namespace App\Livewire\Dokter;

use App\Exports\DokterExport;
use App\Imports\DokterImport;
use App\Models\Dokter;
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
        $dokter->sip = $this->sip;
        $dokter->user = auth()->user()->id;
        $dokter->pic = auth()->user()->name;
        $dokter->save();
        $this->resetForm();
        $this->closeForm();
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
        $this->form = true;
    }
    public function closeForm()
    {
        $this->form = false;
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $dokters = Dokter::where('nama', 'like', $search)->paginate();
        return view('livewire.dokter.dokter-index', compact('dokters'))->title('Dokter');
    }
}
