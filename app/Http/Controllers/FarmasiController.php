<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;

class FarmasiController extends Controller
{
    public function print_resep($kodebooking)
    {
        $antrian = Antrian::where('kodebooking', $kodebooking)->first();
        $resepobat = $antrian->resepobat;
        $resepobatdetails = $antrian->resepobatdetails;
        return view('livewire.farmasi.print_resep_obat', compact('antrian','resepobat','resepobatdetails'));
    }
}
