<?php

use App\Livewire\Pegawai\PegawaiCreate;
use App\Livewire\Pegawai\PegawaiIndex;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('pegawai', PegawaiIndex::class)->name('pegawai.index');
Route::get('pegawai/create', PegawaiCreate::class)->name('pegawai.create');

Route::get('user', UserIndex::class)->name('user.index');
