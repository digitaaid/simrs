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
            'crud-absensi',
            'crud-pasien',
            'crud-dokter',
            'crud-perawat',
            'crud-unit',
            'crud-pegawai',
            'crud-tindakan',
            'crud-jaminan',
            'crud-diagnosa',
            'pendaftaran-rawat-jalan',
            'perawat-rawat-jalan',
            'dokter-rawat-jalan',
            'pendaftaran-rawat-darurat',
            'perawat-rawat-darurat',
            'dokter-rawat-darurat',
            'pendaftaran-rawat-inap',
            'perawat-rawat-inap',
            'dokter-rawat-inap',
            'farmasi',
            'apotek',
            'laboratorium',
            'radiologi',
            'kemoterapi',
            'bank-darah',
            'kasir',
            'keuangan',
            'inacbg',
            'satu-sehat',
            'antrian-bpjs',
            'vclaim-bpjs',
        ];
        foreach ($permission as $item) {
            $permission = Permission::create(['name' => Str::slug($item)]);
        }
        $role = Role::create(['name' => 'Admin Super']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
    }
}
