<?php

namespace App\Livewire\Dokter;

use App\Models\Antrian;
use App\Models\JadwalDokter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class PemeriksaanDokterRajal extends Component
{
    public $tanggalperiksa, $jadwal;
    public $search = '';
    public $antrians, $jadwals = [];
    public function mount(Request $request)
    {
        $this->tanggalperiksa = $request->tanggalperiksa;
        $this->jadwal = $request->jadwal;
    }
    public function cariantrian()
    {
        $this->validate([
            'tanggalperiksa' => 'required|date',
            'jadwal' => 'required',

        ]);
        $this->tanggalperiksa = $this->tanggalperiksa;
        $this->jadwal = $this->jadwal;
    }
    public function render()
    {
        if ($this->tanggalperiksa) {
            $search = '%' . $this->search . '%';
            $this->jadwals = JadwalDokter::where('hari', Carbon::parse($this->tanggalperiksa)->dayOfWeek)
                ->with(['dokter', 'unit'])
                ->get();
            $this->antrians = Antrian::where('tanggalperiksa', $this->tanggalperiksa)
                ->where('jadwal_id', "like", "%" . $this->jadwal . "%")
                ->where('taskid', '>=', 3)
                ->where('taskid', '!=', 99)
                ->leftJoin('asesmen_rajals', 'antrians.id', '=', 'asesmen_rajals.antrian_id')
                ->with(['kunjungan', 'kunjungan.units', 'kunjungan.dokters', 'layanans', 'asesmenrajal', 'pic1'])
                ->orderBy('asesmen_rajals.status_asesmen_dokter', 'asc')
                ->select('antrians.*')
                ->where('antrians.nama', 'like', $search)
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
        return view('livewire.dokter.pemeriksaan-dokter-rajal')->title('Pemeriksaan Dokter Rajal');
    }
}
