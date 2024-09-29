<?php

namespace App\Console\Commands;

use App\Http\Controllers\WhatsappController;
use App\Models\ShiftPegawai;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class PengigatAbsensi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:pengigat-absensi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(Request $request)
    {
        try {
            $user = User::get();
            $api = new WhatsappController();
            $absensis = ShiftPegawai::where('tanggal', now()->format('Y-m-d'))->get();
            foreach ($absensis as $absensi) {
                if ($absensi->user) {
                    $this->info($absensi->user?->name . ' terkirim');
                } else {
                    $this->info($absensi->user_id . ' terkirim');
                }
            }
            // foreach ($absensis as $absensi) {
            //     if ($absensi->user) {
            //         $request['number'] = $absensi->user?->phone;
            //         $request['message'] = "Test Percobaan. Selamat pagi 😊🙏\nSebagai pengingat anda hari ini memiliki jadwal absensi " . $absensi->nama_shift . " pukul " . $absensi->jam_masuk . "-" . $absensi->jam_pulang . " . Jangan lupa absensi tetap waktu ya. 😉\nSemoga semoga hari ini segala urusan kita diperlancar 🤲😊\n\nklinikkitasehat.com";
            //         $res =  $api->send_message($request);
            //         $this->info($absensi->user?->name . ' terkirim');
            //     }
            // }
            // $this->info('Pesan Whatsapp Pengingat Absensi telah dikirim!');
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
}
