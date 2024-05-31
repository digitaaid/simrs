<?php

namespace App\Livewire\Jadwaldokter;

use App\Models\Dokter;
use App\Models\JadwalDokter;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class JadwalDokterIndex extends Component
{
    use WithPagination;
    public $id, $hari, $dokter, $unit, $jampraktek, $mulai, $selesai, $kapasitas;
    public JadwalDokter $jadwal;
    public $form = false;
    public $dokters = [];
    public $units = [];
    public $haris = [
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jumat',
        6 => 'Sabtu',
        7 => 'Minggu',
    ];
    public function libur(JadwalDokter $jadwal)
    {
        $libur = $jadwal->libur ? 0 : 1;
        $jadwal->libur =  $libur;
        $jadwal->save();
        flash('Jadwal hari ' . $jadwal->namahari . ' ' . $jadwal->namadokter . ' diliburkan', 'success');
    }
    public function destroy(JadwalDokter $jadwal)
    {
        $jadwal->delete();
        flash('Jadwal Hari ' . $jadwal->namahari . ' ' . $jadwal->namadokter . ' deleted successfully.', 'success');
        $this->form = false;
    }
    public function edit(JadwalDokter $jadwal)
    {
        $this->id = $jadwal->id;
        $this->hari = $jadwal->hari;
        $this->dokter = $jadwal->kodedokter;
        $this->unit = $jadwal->kodepoli;
        $this->mulai = explode('-', $jadwal->jampraktek)[0];
        $this->selesai = explode('-', $jadwal->jampraktek)[1];
        $this->kapasitas = $jadwal->kapasitas;
        $this->form = true;
    }
    public function store()
    {
        $this->validate([
            'hari' => 'required',
            'dokter' => 'required',
            'unit' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'kapasitas' => 'required',
        ]);
        $jadwal = JadwalDokter::updateOrCreate(
            [
                'hari' => $this->hari,
                'kodedokter' => $this->dokter,
                'jampraktek' => $this->mulai . '-' . $this->selesai,
            ],
            [
                'kodepoli' => $this->unit,
                'kodesubspesialis' => $this->unit,
                'namahari' => $this->haris[$this->hari],
                'namapoli' => $this->units[$this->unit],
                'namasubspesialis' => $this->units[$this->unit],
                'namadokter' => $this->dokters[$this->dokter],
                'kapasitas' => $this->kapasitas,
                'user' => auth()->user()->id,
                'pic' => auth()->user()->name,
            ]
        );
        flash('Jadwal Hari ' . $jadwal->namahari . ' ' . $jadwal->namadokter . ' saved successfully.', 'success');
        $this->formJadwal();
        $this->form = false;
    }
    public function formJadwal()
    {
        $this->form =  $this->form ? false : true;
        $this->reset(['id', 'hari', 'dokter', 'unit', 'mulai', 'selesai', 'kapasitas']);
    }
    public $search = '';
    public $sortBy = 'hari';
    public $sortDirection = 'asc';
    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $field;
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $this->dokters = Dokter::pluck('nama', 'kode');
        $this->units = Unit::pluck('nama', 'kode');
        $jadwals = JadwalDokter::with(['dokter', 'unit'])
            ->where('namadokter', 'like', $search)
            ->orWhere('namapoli', 'like', $search)
            ->orWhere('namahari', 'like', $search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate();
        return view('livewire.jadwaldokter.jadwal-dokter-index', compact('jadwals'))->title('Jadwal Dokter Rawat Jalan');
    }
}
