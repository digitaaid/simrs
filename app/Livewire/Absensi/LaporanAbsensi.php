<?php

namespace App\Livewire\Absensi;

use App\Models\ShiftPegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class LaporanAbsensi extends Component
{
    public $absensis;
    public function  mount()
    {
        $id = auth()->user()->id;
        $this->absensis = ShiftPegawai::where('user_id', $id)->get();
    }
    public function  print()
    {
        $user = auth()->user();
        $absensis = ShiftPegawai::where('user_id', $user->id)->get();
        return view('print.pdf_laporan_absensi', compact('absensis', 'user'));
        $pdf = Pdf::loadView('print.pdf_resep_obat', compact('resepobatdetails', 'resepobat', 'kunjungan', 'url'));
        return $pdf->stream('etiket.pdf');
    }
    public function render()
    {
        return view('livewire.absensi.laporan-absensi')->title('Laporan Absensi');
    }
}
