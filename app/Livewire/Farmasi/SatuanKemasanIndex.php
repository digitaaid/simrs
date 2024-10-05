<?php

namespace App\Livewire\Farmasi;

use App\Exports\SatuanKemasanExport;
use App\Imports\SatuanKemasanImport;
use App\Models\ActivityLog;
use App\Models\SatuanKemasan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class SatuanKemasanIndex extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $nama, $satuanId, $search;
    public $isEdit = false;
    public $form = false;
    public $formImport = false;
    public $fileImport;


    protected $rules = [
        'nama' => 'required|string|max:255',
    ];

    public function render()
    {
        return view('livewire.farmasi.satuan-kemasan-index', [
            'satuanObat' => SatuanKemasan::where('nama', 'like', '%' . $this->search . '%')->paginate(10)
        ]);
    }

    public function resetInput()
    {
        $this->nama = null;
        $this->satuanId = null;
        $this->isEdit = false;
        $this->form = false;
    }

    public function tambah()
    {
        $this->resetInput();
        $this->form = true;
    }

    public function store()
    {
        $this->validate();
        SatuanKemasan::create(['nama' => $this->nama]);
        session()->flash('message', 'Satuan obat berhasil ditambahkan.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $this->form = true;
        $satuan = SatuanKemasan::findOrFail($id);
        $this->satuanId = $id;
        $this->nama = $satuan->nama;
    }

    public function update()
    {
        $this->validate();
        $satuan = SatuanKemasan::findOrFail($this->satuanId);
        $satuan->update(['nama' => $this->nama]);
        session()->flash('message', 'Satuan obat berhasil diperbarui.');
        $this->resetInput();
    }

    public function hapus($id)
    {
        SatuanKemasan::findOrFail($id)->delete();
        session()->flash('message', 'Satuan obat berhasil dihapus.');
        $this->resetInput();
    }

    public function tutup()
    {
        $this->resetInput();
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');

            ActivityLog::createLog(
                'Export satuan_kemasan',
                auth()->user()->name . ' mengekspor data satuan_kemasan'
            );

            flash('Export successfully', 'success');
            return Excel::download(new SatuanKemasanExport, 'satuan_kemasan_backup_' . $time . '.xlsx');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function importform()
    {
        $this->formImport = $this->formImport ?  0 : 1;
    }
    public function import()
    {
        try {
            $this->validate([
                'fileImport' => 'required|mimes:xlsx'
            ]);

            Excel::import(new SatuanKemasanImport, $this->fileImport->getRealPath());

            ActivityLog::createLog(
                'Import satuan kemasan',
                auth()->user()->name . ' mengimpor data satuan kemasan'
            );
            Alert::success('Success', 'Imported successfully');
            return redirect()->route('satuan.kemasan');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
}
