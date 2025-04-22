<?php

namespace App\Providers;

use App\Models\Pengaturan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

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
        if ($pengaturan = Pengaturan::first()) {
            Config::set('adminlte.title',  $pengaturan->nama);
            Config::set('adminlte.logo', '<b>' . $pengaturan->nama . '</b>');
            Config::set('adminlte.logo_img', $pengaturan->logo_icon ? asset('storage/pengaturan/' . $pengaturan->logo_icon) : asset('vendor/adminlte/dist/img/AdminLTELogo.png'));
            Config::set('adminlte.auth_img', $pengaturan->auth_img ? asset('storage/pengaturan/' . $pengaturan->auth_img) : asset('vendor/adminlte/dist/img/AdminLTELogo.png'));
        }
    }
}
