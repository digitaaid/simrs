<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function resumerajal($kodebooking){
        $antrian = Antrian::where('kodebooking', $kodebooking)->first();
        return view('print.pdf_resumerajal',  compact('antrian'));
    }
}
