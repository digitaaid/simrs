<?php

namespace App\Livewire\Rajal;

use App\Models\Antrian;
use App\Models\JadwalDokter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class KeperawatanRajal extends Component
{
    public $tanggalperiksa, $jadwal;
    public $search = '';
    public $antrians, $jadwals = [];

    public function mount()
    {
        $this->tanggalperiksa = request('tanggalperiksa', now()->format('Y-m-d'));
        $this->jadwal = request('jadwal');
    }

    public function cariantrian()
    {
        $this->validate([
            'tanggalperiksa' => 'required|date',
            'jadwal' => 'required',
        ]);
    }

    public function render()
    {
        if ($this->tanggalperiksa) {
            $search = '%' . $this->search . '%';
            $this->jadwals = JadwalDokter::where('hari', Carbon::parse($this->tanggalperiksa)->dayOfWeek)
                ->with(['dokter', 'unit'])
                ->get();
            $this->antrians = Antrian::where('tanggalperiksa', $this->tanggalperiksa)
                ->when($this->jadwal, function ($query) {
                    return $query->where('jadwal_id', $this->jadwal);
                })
                ->where('taskid', '>=', 3)
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
        return view('livewire.rajal.keperawatan-rajal')->title('Pemeriksaan Perawat Rajal');
    }
}

