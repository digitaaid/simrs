<?php

namespace App\Livewire\Perawat;

use App\Exports\TindakanExport;
use App\Imports\TindakanImport;
use App\Models\Tindakan;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class TindakanIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $tindakan;
    public $nama, $klasifikasi, $jenispasien, $jasa_pelayanan, $jasa_rs, $harga;
    public $search = '';
    public $form = false;
    public $formImport = false;
    public $fileTindakanImport;
    public function store()
    {
        if ($this->tindakan) {
            $tindakan = $this->tindakan;
        } else {
            $tindakan = new Tindakan();
        }
        $tindakan->nama = $this->nama;
        $tindakan->klasifikasi = $this->klasifikasi;
        $tindakan->jenispasien = $this->jenispasien;
        $tindakan->jasa_pelayanan = $this->jasa_pelayanan;
        $tindakan->jasa_rs = $this->jasa_rs;
        $tindakan->harga = $this->harga;
        $tindakan->status =  1;
        $tindakan->user = auth()->user()->id;
        $tindakan->pic = auth()->user()->name;
        $tindakan->save();
        $this->reset(['nama', 'klasifikasi', 'jenispasien', 'jasa_pelayanan', 'jasa_rs', 'harga']);
        $this->openForm();
        flash('Obat ' . $tindakan->nama . ' saved successfully', 'success');
    }
    public function edit(Tindakan $tindakan)
    {
        $this->tindakan = $tindakan;
        $this->nama = $tindakan->nama;
        $this->klasifikasi = $tindakan->klasifikasi;
        $this->jenispasien = $tindakan->jenispasien;
        $this->jasa_pelayanan = $tindakan->jasa_pelayanan;
        $this->jasa_rs = $tindakan->jasa_rs;
        $this->harga = $tindakan->harga;
        $this->openForm();
    }
    public function import()
    {
        try {
            $this->validate([
                'fileTindakanImport' => 'required|mimes:xlsx'
            ]);
            Excel::import(new TindakanImport, $this->fileTindakanImport->getRealPath());
            flash('Import Tindakan successfully', 'success');
            $this->formImport = false;
            $this->fileTindakanImport = null;
            return redirect()->route('tindakan.index');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');
            return Excel::download(new TindakanExport, 'tindakan_backup_' . $time . '.xlsx');
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
    public function mount()
    {
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $tindakans = Tindakan::where('nama', 'like', $search)->paginate();
        return view('livewire.perawat.tindakan-index', compact('tindakans'))->title('Tindakan Pelayanan');
    }
}
