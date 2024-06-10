<?php

namespace App\Livewire\Perawat;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Livewire\Component;

class PemeriksaanPerawatRajal extends Component
{
    public $tanggalperiksa;
    public $antrians;
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
            $this->antrians = Antrian::where('tanggalperiksa', $this->tanggalperiksa)
                ->where('taskid', '>=', 3)
                ->where('taskid', '!=', 99)
                ->leftJoin('asesmen_rajals', 'antrians.id', '=', 'asesmen_rajals.antrian_id')
                ->with(['kunjungan', 'kunjungan.units', 'kunjungan.dokters', 'layanans', 'asesmenrajal', 'pic1'])
                ->orderBy('asesmen_rajals.status_asesmen_perawat', 'asc')
                ->select('antrians.*')
                ->get();
        }
        return view('livewire.perawat.pemeriksaan-perawat-rajal')->title('Pemeriksaan Perawat Rajal');
    }
}
