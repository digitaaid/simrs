<?php

namespace App\Providers;

use App\Models\Pengaturan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $pengaturan = Pengaturan::first();
        Config::set('adminlte.logo', '<b>' . ($pengaturan ? $pengaturan->nama : 'Default Name') . '</b>');
    }
}
