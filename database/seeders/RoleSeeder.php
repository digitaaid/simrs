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
        ];
        foreach ($roles as $item) {
            $permission = Permission::create(['name' => Str::slug($item)]);
            $role = Role::create(['name' => $item]);
            $role->syncPermissions($permission);
        }
        $permission = [
            'data-role-permission',
            'data-aplikasi',
            'data-whatsapp',

            'data-pasien',
            'data-dokter',
            'data-unit',
            'data-jadwaldokter',
            'data-pegawai',
            'data-absensi',
            'data-perawat',

            'data-tindakan',
            'data-jaminan',
            'data-diagnosa',

            'rajal-pendaftaran',
            'rajal-keperawatan',
            'rajal-pemeriksaan',
            'rajal-farmasi',
            'rajal-kasir',

            'igd-pendaftaran',
            'igd-keperawatan',
            'igd-pemeriksaan',
            'igd-farmasi',
            'igd-kasir',

            'ranap-pendaftaran',
            'ranap-keperawatan',
            'ranap-pemeriksaan',
            'ranap-farmasi',
            'ranap-kasir',

            'inacbg',
            'satusehat',
            'bpjs-antrian',
            'bpjs-vclaim',

            'farmasi',
            'apotek',
            'laboratorium',
            'radiologi',
            'kemoterapi',
            'bank-darah',
            'kasir',
            'keuangan',
        ];
        foreach ($permission as $item) {
            $permission = Permission::create(['name' => Str::slug($item)]);
        }
        $role = Role::create(['name' => 'Admin Super']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
    }
}
