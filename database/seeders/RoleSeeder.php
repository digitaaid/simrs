<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Admin',
            'Pendaftaran',
            'Perawat',
            'Dokter',
            'Farmasi',
            'Kasir',
            'Rekam Medis',
            'Keuangan',
            'Manajemen',
            'Manajemen Pelayanan',
            'Manajemen Farmasi',
            'Apoteker',
            'Pegawai',
            'Satu Sehat',
            'Antrian BPJS',
            'Vclaim BPJS',
        ];
        foreach ($roles as $item) {
            $permission = Permission::create(['name' => Str::slug($item)]);
            $role = Role::create(['name' => $item]);
            $role->syncPermissions($permission);
        }
        $permission = [
            'crud-absensi',
        ];
        foreach ($permission as $item) {
            $permission = Permission::create(['name' => Str::slug($item)]);
        }
        $role = Role::create(['name' => 'Admin Super']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
    }
}
