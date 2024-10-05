<?php

namespace App\Livewire\Farmasi;

use App\Models\SupplierObat;
use Livewire\Component;

class SupplierObatIndex extends Component
{
    public $suppliers, $nama, $alamat, $kontak, $email, $nohp, $supplier_id;
    public $form = false;
    public function render()
    {
        return view('livewire.farmasi.supplier-obat-index')->title('Supplier Obat');
    }
    public function mount()
    {
        $this->suppliers = SupplierObat::all();
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
        $this->email = '';
        $this->nohp = '';
        $this->supplier_id = '';
    }
    // Menyimpan data pemasok (create atau update)
    public function store()
    {
        // Validasi input form
        $this->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'nohp' => 'nullable|string|max:20',
        ]);

        // Buat atau perbarui data SupplierObat
        SupplierObat::updateOrCreate(
            ['id' => $this->supplier_id], // Jika ID ada, perbarui; jika tidak, buat baru
            [
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'kontak' => $this->kontak,
                'email' => $this->email,
                'nohp' => $this->nohp,
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

        $this->form = true; // Buka form untuk edit
    }
    // Menghapus data pemasok
    public function delete($id)
    {
        SupplierObat::findOrFail($id)->delete();
        session()->flash('message', 'Data pemasok berhasil dihapus.');
    }
}
