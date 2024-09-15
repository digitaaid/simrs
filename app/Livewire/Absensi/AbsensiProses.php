<?php

namespace App\Livewire\Absensi;

use App\Models\ShiftPegawai;
use Livewire\Component;

class AbsensiProses extends Component
{
    public $user, $shift;
    public function mount()
    {
        $this->user = auth()->user();
        $this->shift = ShiftPegawai::where('user_id', $this->user->id)
            ->where('tanggal', now()->format('Y-m-d'))
            ->first();
    }
    public function render()
    {
        return view('livewire.absensi.absensi-proses')->title('Proses Absensi');
    }
}
