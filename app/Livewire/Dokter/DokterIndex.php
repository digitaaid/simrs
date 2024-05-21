<?php

namespace App\Livewire\Dokter;

use App\Models\Dokter;
use Livewire\Component;
use Livewire\WithPagination;

class DokterIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $form = false;
    public $id, $nama, $kode, $kodejkn, $nik, $user_id, $idpractitioner, $title, $gender, $sip, $image, $status, $user, $pic;

    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => 'required',
        ]);
        $dokter =  Dokter::updateOrCreate(
            [
                'id' => $this->id,
                'kode' => $this->kode,

            ],
            [
                'nama' => $this->nama,
                'kodejkn' => $this->kodejkn,
                'nik' => $this->nik,
                'user_id' => $this->user_id,
                'idpractitioner' => $this->idpractitioner,
                'title' => $this->title,
                'user' => auth()->user()->id,
                'pic' => auth()->user()->name,
            ]
        );
        $this->resetForm();
        $this->closeForm();
        flash('Dokter ' . $dokter->name . ' saved successfully', 'success');
    }
    public function edit(Dokter $dokter)
    {
        $this->id = $dokter->id;
        $this->nama = $dokter->nama;
        $this->kode = $dokter->kode;
        $this->kodejkn = $dokter->kodejkn;
        $this->nik = $dokter->nik;
        $this->user_id = $dokter->user_id;
        $this->idpractitioner = $dokter->idpractitioner;
        $this->title = $dokter->title;
        $this->openForm();
    }
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        flash('Dokter ' . $dokter->name . ' deleted successfully', 'success');
    }
    public function resetForm()
    {
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
