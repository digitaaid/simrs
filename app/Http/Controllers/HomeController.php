<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Dokter;
use App\Models\ShiftPegawai;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $absensi = ShiftPegawai::where('user_id', $user->id)
            ->where('tanggal', now()->format('Y-m-d'))->first();
        $logs = ActivityLog::where('user_id', $user->id)->limit(15)->get();
        return view('home', compact('absensi', 'logs'));
    }
    public function  landingpage()
    {
        $dokters = Dokter::where('status', 1)->get();
        return view('kitasehat', compact('dokters'));
    }
}
