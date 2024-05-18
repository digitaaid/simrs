<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "name" => "Marwan Dhiaur Rahman",
            "email" => "marwandhiaurrahman@gmail.com",
            'password' => bcrypt('qweqweqwe'),
            'email_verified_at' => now()
        ]);
        $user->assignRole('Admin Super');
        $roles = [
            'Admin',
            'Pegawai',
        ];
        foreach ($roles as  $value) {
            $user = User::create([
                "name" => $value,
                "email" => Str::slug($value) . "@gmail.com",
                'password' => bcrypt(Str::slug($value)),
                'email_verified_at' => now()
            ]);
            $user->assignRole($value);
        }
    }
}
