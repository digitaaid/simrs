<?php

namespace App\Livewire\Igd;

use App\Models\Soap;
use Livewire\Component;

class ModalSoap extends Component
{
    public $kunjungan;
    public $soaps;
    public $showModal = false;
    public $id, $tanggal, $ppa, $subject, $object, $assesment, $plan, $implementation, $evaluation, $revised;

    public function edit($id)
    {
        $this->id = $id;
        $soap = Soap::find($id);
        $this->tanggal = $soap->tanggal;
        $this->ppa = $soap->ppa;
        $this->subject = $soap->subject;
        $this->object = $soap->object;
        $this->assesment = $soap->assesment;
        $this->plan = $soap->plan;
        $this->implementation = $soap->implementation;
        $this->evaluation = $soap->evaluation;
        $this->revised = $soap->revised;
        $this->showModal = true;
    }

    public function simpan()
    {
        $this->validate([
            'tanggal' => 'required',
            'ppa' => 'required',
        ]);
        $this->showModal = false;
        $soap = Soap::updateOrCreate(
            [
                'id' => $this->id,
            ],
            [
                'kunjungan_id' => $this->kunjungan->id,
                'tanggal' => $this->tanggal,
                'ppa' => $this->ppa,
                'subject' => $this->subject,
                'object' => $this->object,
                'assesment' => $this->assesment,
                'plan' => $this->plan,
                'implementation' => $this->implementation,
                'evaluation' => $this->evaluation,
                'revised' => $this->revised,
                'pic' => auth()->user()->name,
                'user' => auth()->user()->id,
            ]
        );
        return flash('SOAP berhasil disimpan.', 'success');
    }

    public function tambah()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function hapus($id)
    {
        $soap = Soap::find($id);
        if ($soap) {
            $soap->delete();
            $this->soaps = Soap::where('kunjungan_id', $this->kunjungan->id)->get();
            return flash('SOAP berhasil dihapus.', 'success');
        }
        return flash('SOAP tidak ditemukan.', 'error');
    }

    private function resetFields()
    {
        $this->id = null;
        $this->tanggal = null;
        $this->ppa = null;
        $this->subject = null;
        $this->object = null;
        $this->assesment = null;
        $this->plan = null;
        $this->implementation = null;
        $this->evaluation = null;
        $this->revised = null;
    }

    public function mount($kunjungan)
    {
        $this->kunjungan = $kunjungan;
    }

    public function render()
    {
        $this->soaps = Soap::where('kunjungan_id', $this->kunjungan->id)->get();
        return view('livewire.igd.modal-soap');
    }
}
