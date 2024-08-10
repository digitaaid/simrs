<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
    protected $guarded = ['id'];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function adminlte_image()
    {
        if ($this->avatar) {
            return $this->avatar;
        } else {
            return asset('simrs/logoprofile.png');
        }
    }
    public function adminlte_profile_url()
    {
        return route('profil');
    }
    public function pegawai()
    {
        return $this->hasOne(Pegawai::class);
    }
}
