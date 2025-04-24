<?php

namespace App\Livewire\Kamarbed;

use App\Exports\BedExport;
use App\Imports\BedImport;
use App\Models\Bed;
use App\Models\Kamar;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class BedIndex extends Component
{
    use WithFileUploads;
    public $form = 0, $formimport = 0, $fileimport;
    public $kamars, $beds;
    public $bed, $id, $kamar_id, $nomorbed, $bedpria, $bedwanita, $status;
    public function render()
    {
        $this->beds = Bed::get();
        return view('livewire.kamarbed.bed-index');
    }
    public function store()
    {
        $kamar = Kamar::find($this->kamar_id);
        $bed = Bed::updateOrCreate(
            [
                'id' => $this->id,
            ],
            [
                'nomorbed' => $this->nomorbed,
                'koderuang' => $kamar->koderuang,
                'namaruang' => $kamar->namaruang,
                'unit_id' => $kamar->unit_id,
                'kamar_id' => $kamar->id,
                'bedpria' => $this->bedpria ?? 1,
                'bedwanita' => $this->bedwanita ?? 1,
                'status' => 0,
                'user' => auth()->user()->id,
                'pic' => auth()->user()->name,
            ]
        );
        $this->form = 0;
        flash('Berhasil simpan data bed', 'success');
    }
    public function edit(Bed $bed)
    {
        $this->id = $bed->id;
        $this->kamar_id = $bed->kamar_id;
        $this->nomorbed = $bed->nomorbed;
        $this->bedpria = $bed->bedpria;
        $this->bedwanita = $bed->bedwanita;
        $this->status = $bed->status;
        $this->form = 1;
    }
    public function terisi(Bed $bed)
    {
        $bed->update([
            'status' => $bed->status == 1 ? 0 : 1,
        ]);
        $message = $bed->status == 1 ? 'Berhasil ubah status bed menjadi terisi' : 'Berhasil ubah status bed menjadi kosong';
        flash($message, 'success');
    }
    public function hapus(Bed $bed)
    {
        $this->status = $bed->delete();
        flash('Berhasil hapus data bed', 'success');
    }
    public function tambah()
    {
        $this->form = $this->form ? 0 : 1;
        $this->reset(['bed', 'id', 'kamar_id', 'nomorbed', 'bedpria', 'bedwanita', 'status']);
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');
            return Excel::download(new BedExport, 'bed_backup_' . $time . '.xlsx');
            flash('Export Kamar successfully', 'success');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function importform()
    {
        $this->formimport = $this->formimport ? 0 : 1;
        $this->reset(['fileimport']);
    }
    public function import()
    {
        try {
            $this->validate([
                'fileimport' => 'required|mimes:xlsx'
            ]);
            Excel::import(new BedImport, $this->fileimport->getRealPath());
            flash('Import Bed successfully', 'success');
            $this->formimport = 0;
            $this->fileimport = null;
            return redirect()->route('kamar.bed.index');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function mount()
    {
        $this->kamars = Kamar::get();
    }
}
