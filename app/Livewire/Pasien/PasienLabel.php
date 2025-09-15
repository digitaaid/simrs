<?php

namespace App\Livewire\Pasien;

use App\Models\Pasien;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Livewire\Component;

class PasienLabel extends Component
{
    public $nik, $nomorkartu, $norm, $pasien;
    public $noidentitas;


    public function print_label(Request $request)
    {
        $pasien = Pasien::where('norm', $request->norm)->first();
        // return view('livewire.pasien.etiket-label-pasien', compact('pasien'));
        $pdf = Pdf::loadView('livewire.pasien.etiket-label-pasien', compact('pasien'));
        return $pdf->stream('labelpasien.pdf');
    }

    public function cari()
    {
        $pasien = Pasien::where('norm', $this->noidentitas)->first();
        if ($pasien) {
            $this->pasien = $pasien;
            flash('Data pasien ditemukan', 'success');
        } else {
            flash('Data pasien tidak ditemukan', 'danger');
        }
    }
    public function render()
    {
        return view('livewire.pasien.pasien-label')->title('Label Pasien');
    }
}
