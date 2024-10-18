<?php

namespace App\Livewire\Antrian;

use App\Models\JadwalDokter;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class AnjunganAntrian extends Component
{
    public $kodebooking;
    public $jenispasien;
    public $jadwals;
    public function test()
    {
        return view('livewire.antrian.anjungan-antrian-test');
    }
    public function reload()
    {
        Alert::success('Success', 'Reload');
        return redirect()->route('anjunganantrian.index');
    }
    public function checkin()
    {
        dd('test');
    }
    public function render()
    {
        $this->jadwals = JadwalDokter::where('hari', now()->dayOfWeek)->get();
        return view('livewire.antrian.anjungan-antrian')->layout('components.layouts.layout_anjungan');
    }
}
