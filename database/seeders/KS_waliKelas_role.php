<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class KS_waliKelas_role extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => 2,
                'nama_role' => 'Wali Kelas',
            ],
            [
                'id' => 3,
                'nama_role' => 'Kepala Sekolah',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
