<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            "name" => "Marwan Dhiaur Rahman",
            "username" => "marwan",
            "email" => "marwandhiaurrahman@gmail.com",
            "phone" => "089529909036",
            'password' => bcrypt('qweqweqwe'),
            'email_verified_at' => now()
        ]);
        $user->assignRole('Admin Super');
        $user = User::create([
            "name" => "Bridging Antrian BPJS",
            "username" => "antrianbpjs",
            "email" => "marwandhiaurrahman@gmail.com",
            "phone" => "089529909036",
            'password' => bcrypt('antrianbpjs'),
            'email_verified_at' => now()
        ]);
    }
}
