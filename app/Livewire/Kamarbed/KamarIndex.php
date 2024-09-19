<?php

namespace App\Livewire\Kamarbed;

use App\Exports\KamarExport;
use App\Imports\KamarImport;
use App\Models\Kamar;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class KamarIndex extends Component
{
    use WithFileUploads;
    public $form = 0, $formimport = 0, $fileimport;
    public $units, $kamars;
    public $id, $unit_id, $koderuang, $nama, $kodekelas, $kapasitastotal, $kapasitaspria, $kapasitaswanita, $kapasitaspriawanita;
    public function store()
    {
        $unit = Unit::find($this->unit_id);
        $kamar = Kamar::updateOrCreate(
            [
                'unit_id' => $unit->id,
                'koderuang' => $unit->kode,
            ],
            [
                'namaruang' => $unit->nama,
                'kodekelas' => $this->kodekelas,
                'kapasitastotal' => $this->kapasitastotal ?? 0,
                'kapasitaspria' => $this->kapasitaspria ?? 0,
                'kapasitaswanita' => $this->kapasitaswanita ?? 0,
                'kapasitaspriawanita' => $this->kapasitaspriawanita ?? 0,
                'status' => 1,
                'user' => auth()->user()->id,
                'pic' => auth()->user()->name,
            ]
        );
        $this->form = 0;
        flash('Berhasil simpan data kamar', 'success');
    }
    public function edit(Kamar $kamar)
    {
        $this->form = 1;
        $this->id = $kamar->id;
        $this->unit_id = $kamar->unit_id;
        $this->kodekelas = $kamar->kodekelas;
        $this->kapasitastotal = $kamar->kapasitastotal;
        $this->kapasitaspria = $kamar->kapasitaspria;
        $this->kapasitaswanita = $kamar->kapasitaswanita;
        $this->kapasitaspriawanita = $kamar->kapasitaspriawanita;
    }
    public function tambah()
    {
        $this->form = $this->form ? 0 : 1;
        $this->reset(['id', 'unit_id', 'kodekelas', 'kapasitastotal', 'kapasitaspria', 'kapasitaswanita', 'kapasitaspriawanita']);
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');
            return Excel::download(new KamarExport, 'kamar_backup_' . $time . '.xlsx');
            flash('Export Kamar successfully', 'success');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function importform(){
        $this->formimport = $this->formimport ? 0 : 1;
        $this->reset(['fileimport']);
    }
    public function import()
    {
        try {
            $this->validate([
                'fileimport' => 'required|mimes:xlsx'
            ]);
            Excel::import(new KamarImport, $this->fileimport->getRealPath());
            flash('Import Kamar successfully', 'success');
            $this->formimport = 0;
            $this->fileimport = null;
            return redirect()->route('kamar.bed.index');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function mount()
    {
        $this->units = Unit::where('jenis', 'Pelayanan Rawat Inap')->get();
    }
    public function render()
    {
        $this->kamars = Kamar::get();
        return view('livewire.kamarbed.kamar-index');
    }
}
