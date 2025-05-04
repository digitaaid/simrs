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
            Config::set('adminlte.logo_img', $pengaturan->logo_icon ? 'storage/pengaturan/' . $pengaturan->logo_icon : 'vendor/adminlte/dist/img/AdminLTELogo.png');
            Config::set('adminlte.auth_img', $pengaturan->auth_img ? asset('storage/pengaturan/' . $pengaturan->auth_img) : asset('vendor/adminlte/dist/img/AdminLTELogo.png'));
            Config::set('adminlte.logo_karcis', $pengaturan->logo_karcis ? 'storage/pengaturan/' . $pengaturan->logo_karcis : 'vendor/adminlte/dist/img/AdminLTELogo.png');
            Config::set('adminlte.anjungan_color', $pengaturan->anjungan_color ?? 'green');
            Config::set('adminlte.anjungan_qr', $pengaturan->anjungan_qr ? 'storage/pengaturan/' . $pengaturan->anjungan_qr : 'img/image-placeholder.jpg');
            Config::set('adminlte.anjungan_img_info', $pengaturan->anjungan_img_info ? 'storage/pengaturan/' . $pengaturan->anjungan_img_info : 'img/image-placeholder.jpg');
        }
    }
}
