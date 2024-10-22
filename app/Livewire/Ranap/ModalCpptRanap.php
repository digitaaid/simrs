<?php

namespace App\Livewire\Ranap;

use App\Models\CpptRanap;
use App\Models\Kunjungan;
use Livewire\Component;

class ModalCpptRanap extends Component
{
    public $kunjungan, $inputs;
    public $id, $tgl_input, $profesi, $subjective, $objective, $assessment, $plan, $dokter_jaga, $dokter_dpjp;
    public $form = false;
    protected $listeners = ['refreshPage' => 'loadData'];
    public function loadData()
    {
        $this->inputs = $this->kunjungan->cppt_ranap;
    }
    public function render()
    {
        return view('livewire.ranap.modal-cppt-ranap');
    }
    public function mount(Kunjungan $kunjungan)
    {
        $this->kunjungan = $kunjungan;
        $this->inputs = $kunjungan->cppt_ranap;
    }
    public function inputCppt()
    {
        $this->reset(['id', 'tgl_input', 'profesi', 'subjective', 'objective', 'assessment', 'plan', 'dokter_jaga', 'dokter_dpjp']);
        $this->tgl_input = now()->format('Y-m-d H:s');
        $this->form = $this->form ? false : true;
    }
    public function simpan()
    {
        $this->validate([
            'tgl_input' => 'required',
            'profesi' => 'required',
        ]);
        $cppt =  CpptRanap::updateOrCreate(
            [
                'id' => $this->id
            ],
            [
                'kunjungan_id' => $this->kunjungan->id,
                'kodekunjungan' => $this->kunjungan->kode,
                'norm' => $this->kunjungan->norm,
                'tgl_input' => $this->tgl_input,
                'profesi' => $this->profesi,
                'subjective' => $this->subjective,
                'objective' => $this->objective,
                'assessment' => $this->assessment,
                'plan' => $this->plan,
                'dokter_jaga' => $this->dokter_jaga,
                'dokter_dpjp' => $this->dokter_dpjp,
                'user' => auth()->user()->id,
                'pic' => auth()->user()->name,
            ]
        );
        $this->form = false;
        $this->reset(['id', 'tgl_input', 'profesi', 'subjective', 'objective', 'assessment', 'plan', 'dokter_jaga', 'dokter_dpjp']);
        $this->dispatch('refreshPage');
        flash('CPPT Rawat Inap Berhasil Disimpan', 'success');
    }
    public function editCppt($id)
    {
        $this->reset(['id', 'tgl_input', 'profesi', 'subjective', 'objective', 'assessment', 'plan', 'dokter_jaga', 'dokter_dpjp']);
        $cppt = CpptRanap::find($id);
        $this->id = $cppt->id;
        $this->tgl_input = $cppt->tgl_input;
        $this->profesi = $cppt->profesi;
        $this->subjective = $cppt->subjective;
        $this->objective = $cppt->objective;
        $this->assessment = $cppt->assessment;
        $this->plan = $cppt->plan;
        $this->dokter_jaga = $cppt->dokter_jaga;
        $this->dokter_dpjp = $cppt->dokter_dpjp;
        $this->form =  true;
    }
    public function hapusCppt($id)
    {
        $cppt = CpptRanap::find($id);
        $cppt->delete();
        $this->form = false;
        $this->reset(['id', 'tgl_input', 'profesi', 'subjective', 'objective', 'assessment', 'plan', 'dokter_jaga', 'dokter_dpjp']);
        $this->dispatch('refreshPage');
        flash('CPPT Rawat Inap Berhasil dihapus', 'success');
    }
}
