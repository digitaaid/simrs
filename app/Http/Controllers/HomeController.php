<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function  landingpage()
    {
        $dokters = Dokter::where('status', 1)->get();
        return view('kitasehat', compact('dokters'));
    }
}
