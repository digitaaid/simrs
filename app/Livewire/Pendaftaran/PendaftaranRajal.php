<?php

namespace App\Livewire\Pendaftaran;

use App\Models\Antrian;
use Livewire\Component;

class PendaftaranRajal extends Component
{
    public $tanggalperiksa;
    public $antrians;
    public $search = '';

    public function mount()
    {
        $this->tanggalperiksa = request('tanggalperiksa', now()->format('Y-m-d'));
    }

    public function caritanggal()
    {
        $this->validate([
            'tanggalperiksa' => 'required|date',
        ]);
    }

    public function render()
    {
        if ($this->tanggalperiksa) {
            $search = '%' . $this->search . '%';
            $this->antrians = Antrian::where('tanggalperiksa', $this->tanggalperiksa)
                ->where(function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('norm', 'like', "%{$search}%");
                })
                ->orderBy('taskid', 'asc')
                ->get();
        } elseif ($this->search) {
            $search = '%' . $this->search . '%';
            $this->antrians = Antrian::where('taskid', '>=', 3)
                ->where('taskid', '!=', 99)
                ->leftJoin('asesmen_rajals', 'antrians.id', '=', 'asesmen_rajals.antrian_id')
                ->with(['kunjungan', 'kunjungan.units', 'kunjungan.dokters', 'layanans', 'asesmenrajal', 'pic1'])
                ->orderBy('taskid', 'asc')
                ->select('antrians.*')
                ->where(function ($query) use ($search) {
                    $query->where('antrians.nama', 'like', "%{$search}%")
                        ->orWhere('antrians.norm', 'like', "%{$search}%");
                })
                ->get();
        }

        return view('livewire.pendaftaran.pendaftaran-rajal')->title('Pendaftaran Rawat Jalan');
    }
}
