<?php

namespace App\Livewire\Pendaftaran;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Livewire\Component;

class PendaftaranRajal extends Component
{
    public $tanggalperiksa;
    public $antrians;
    public $search = '';
    public function mount(Request $request)
    {
        $this->tanggalperiksa = $request->tanggalperiksa;
    }
    public function caritanggal()
    {
        $this->validate([
            'tanggalperiksa' => 'required|date',
        ]);
        $this->tanggalperiksa = $this->tanggalperiksa;
    }
    public function render()
    {
        if ($this->tanggalperiksa) {
            $search = '%' . $this->search . '%';
            $this->antrians = Antrian::where('tanggalperiksa', $this->tanggalperiksa)
                ->where('nama', 'like', $search)
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
                ->where('antrians.nama', 'like', $search)
                ->get();
        }
        return view('livewire.pendaftaran.pendaftaran-rajal')->title('Pendaftaran Rawat Jalan');
    }
}
