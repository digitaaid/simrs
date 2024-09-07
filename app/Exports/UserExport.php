<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::with('roles')->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'phone' => $user->phone,
                'google_id' => $user->google_id,
                'avatar' => $user->avatar,
                'avatar_original' => $user->avatar_original,
                'password' => $user->password,
                'email_verified_at' => $user->email_verified_at,
                'user_verify' => $user->user_verify,
                'pic' => $user->pic,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'deleted_at' => $user->deleted_at,
                'roles' => $user->roles->pluck('name')->implode(', '), // Menambahkan role
            ];
        });
    }
    public function headings(): array
    {
        return [
            'id',
            'name',
            'username',
            'email',
            'phone',
            'google_id',
            'avatar',
            'avatar_original',
            'password',
            'email_verified_at',
            'user_verify',
            'pic',
            'created_at',
            'updated_at',
            'deleted_at',
            'roles',
        ];
    }
}
