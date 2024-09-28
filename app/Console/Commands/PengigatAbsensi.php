<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

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
    public function handle()
    {
        $user = User::get();
        dd($user);
        $this->info('Email telah dikirim!');
    }
}
