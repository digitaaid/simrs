<?php

namespace App\Livewire\Farmasi;

use App\Models\SatuanKemasan;
use Livewire\Component;
use Livewire\WithPagination;

class SatuanKemasanIndex extends Component
{
    use WithPagination;

    public $nama, $satuanId, $search;
    public $isEdit = false;
    public $form = false;

    protected $rules = [
        'nama' => 'required|string|max:255',
    ];

    public function render()
    {
        return view('livewire.farmasi.satuan-kemasan-index', [
            'satuanObat' => SatuanKemasan::where('nama', 'like', '%'.$this->search.'%')->paginate(10)
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
}
