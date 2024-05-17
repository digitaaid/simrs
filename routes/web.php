<?php

use App\Livewire\Counter;
use App\Livewire\Pegawai\PegawaiCreate;
use App\Livewire\Pegawai\PegawaiForm;
use App\Livewire\Pegawai\PegawaiIndex;
use App\Livewire\Profil\ProfilIndex;
use App\Livewire\User\UserCreate;
use App\Livewire\User\UserForm;
use App\Livewire\User\UserIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('pegawai', PegawaiIndex::class)->name('pegawai.index');
    Route::get('pegawai/create', PegawaiForm::class)->name('pegawai.create');
    Route::get('pegawai/edit/{id}', PegawaiForm::class)->name('pegawai.edit');
    Route::get('user', UserIndex::class)->name('user.index');
    Route::get('user/create', UserForm::class)->name('user.create');
    Route::get('user/edit/{id}', UserForm::class)->name('user.edit');
    Route::get('counter', Counter::class)->name('counter.index');
    Route::get('profil', ProfilIndex::class)->name('profil');
});
