<?php

namespace App\Livewire\Absensi;

use App\Models\ShiftPegawai;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Livewire\Component;

class LaporanAbsensi extends Component
{
    public $absensis;
    public function  mount()
    {
        $id = auth()->user()->id;
        $this->absensis = ShiftPegawai::where('user_id', $id)->get();
    }
    public function  print(Request $request)
    {
        if ($request->user) {
            $user = User::find($request->user);
        } else {
            $user = auth()->user();
        }
        $absensis = ShiftPegawai::where('user_id', $user->id)->get();
        // return view('print.pdf_laporan_absensi', compact('absensis', 'user'));
        $pdf = Pdf::loadView('print.pdf_laporan_absensi', compact('absensis', 'user'));
        return $pdf->stream('laporan_absensi.pdf');
    }
    public function render()
    {
        return view('livewire.absensi.laporan-absensi')->title('Laporan Absensi');
    }
}
