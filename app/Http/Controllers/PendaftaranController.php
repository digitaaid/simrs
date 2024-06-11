<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public  function printkarcis($kodebooking)
    {
        $antrian = Antrian::firstWhere('kodebooking', $kodebooking);
        return view('livewire.antrian.anjungan-antrian-karcis', compact([
            'antrian'
        ]));
    }
    public  function antrianonline($kodebooking)
    {
        $antrian = Antrian::firstWhere('kodebooking', $kodebooking);
        return view('antrianonline', compact([
            'antrian'
        ]));
    }

}
