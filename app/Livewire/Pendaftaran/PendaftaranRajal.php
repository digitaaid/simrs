<?php

namespace App\Livewire\Pendaftaran;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Livewire\Component;

class PendaftaranRajal extends Component
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
                ->orderBy('taskid', 'asc')
                ->get();
        }
        return view('livewire.pendaftaran.pendaftaran-rajal')->title('Pendaftaran Rawat Jalan');
    }
}
