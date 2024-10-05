<?php

namespace App\Livewire\Farmasi;

use App\Exports\SupplierObatExport;
use App\Imports\SupplierObatImport;
use App\Models\ActivityLog;
use App\Models\SupplierObat;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierObatIndex extends Component
{
    use WithFileUploads;
    public $suppliers, $nama, $alamat, $distributor, $kontak, $email, $nohp, $supplier_id;
    public $form = false;
    public $formImport = false;
    public $fileImport;
    public function render()
    {
        $this->suppliers = SupplierObat::all();
        return view('livewire.farmasi.supplier-obat-index')->title('Supplier Obat');
    }
    // Membuka form untuk menambah atau mengedit data
    public function tambah()
    {
        $this->form = !$this->form;
        $this->resetInputFields(); // Reset input saat membuka form baru
    }
    // Mereset input fields setelah penyimpanan atau penutupan form
    private function resetInputFields()
    {
        $this->nama = '';
        $this->alamat = '';
        $this->kontak = '';
        $this->distributor = '';
        $this->email = '';
        $this->nohp = '';
        $this->supplier_id = '';
    }
    // Menyimpan data pemasok (create atau update)
    public function store()
    {
        // Validasi input form
        $this->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'kontak' => 'required|string',
            'distributor' => 'nullable|string',
            'email' => 'nullable|email',
            'nohp' => 'nullable|numeric',
        ]);

        // Buat atau perbarui data SupplierObat
        SupplierObat::updateOrCreate(
            ['id' => $this->supplier_id], // Jika ID ada, perbarui; jika tidak, buat baru
            [
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'distributor' => $this->distributor,
                'kontak' => $this->kontak,
                'email' => $this->email,
                'nohp' => $this->nohp,
                'pic' => auth()->user()->name,
                'user' => auth()->user()->id,
            ]
        );

        // Flash message untuk feedback pengguna
        session()->flash('message', $this->supplier_id
            ? 'Data pemasok berhasil diperbarui.'
            : 'Data pemasok berhasil ditambahkan.');

        // Reset dan tutup form
        $this->form = false;
        $this->resetInputFields();
    }
    // Mengedit data pemasok yang ada
    public function edit($id)
    {
        $supplier = SupplierObat::findOrFail($id);
        $this->supplier_id = $id;
        $this->nama = $supplier->nama;
        $this->alamat = $supplier->alamat;
        $this->kontak = $supplier->kontak;
        $this->email = $supplier->email;
        $this->nohp = $supplier->nohp;
        $this->distributor = $supplier->distributor;

        $this->form = true; // Buka form untuk edit
    }
    // Menghapus data pemasok
    public function delete($id)
    {
        SupplierObat::findOrFail($id)->delete();
        session()->flash('message', 'Data pemasok berhasil dihapus.');
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');

            ActivityLog::createLog(
                'Export supplier_obat',
                auth()->user()->name . ' mengekspor data supplier_obat'
            );

            flash('Export successfully', 'success');
            return Excel::download(new SupplierObatExport, 'supplier_obat_backup_' . $time . '.xlsx');
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

            Excel::import(new SupplierObatImport, $this->fileImport->getRealPath());

            ActivityLog::createLog(
                'Import supplierobat',
                auth()->user()->name . ' mengimpor data supplierobat'
            );
            Alert::success('Success', 'Imported successfully');
            return redirect()->route('supplier.obat');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
}
