<?php

namespace App\Livewire\Igd;

use App\Models\Antrian;
use Livewire\Component;

class PendaftaranIgd extends Component
{
    public $tanggalperiksa;
    public $antrians = [];
    public $search = '';
    public function render()
    {
        if ($this->tanggalperiksa == null) {
            $this->tanggalperiksa = now()->format('Y-m-d');
        }
        if ($this->tanggalperiksa) {
            $search = '%' . $this->search . '%';
            $this->antrians = Antrian::where('tanggalperiksa', $this->tanggalperiksa)
                ->where(function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('norm', 'like', "%{$search}%");
                })
                ->orderBy('taskid', 'asc')
                ->get();
        }
        if ($this->search && $this->tanggalperiksa == null) {
            $search = '%' . $this->search . '%';
            $this->antrians = Antrian::where('taskid', '>=', 3)
                ->where('taskid', '!=', 99)
                ->leftJoin('asesmen_rajals', 'antrians.id', '=', 'asesmen_rajals.antrian_id')
                ->with(['kunjungan', 'kunjungan.units', 'kunjungan.dokters', 'layanans', 'asesmenrajal', 'pic1'])
                ->orderBy('asesmen_rajals.status_asesmen_perawat', 'asc')
                ->select('antrians.*')
                ->where(function ($query) use ($search) {
                    $query->where('antrians.nama', 'like', "%{$search}%")
                        ->orWhere('antrians.norm', 'like', "%{$search}%");
                })
                ->get();
        }
        return view('livewire.igd.pendaftaran-igd')->title('Pendaftaran IGD');
    }
}
