<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\SubKriteria;

class TruncateData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubKriteria::truncate();
        Kriteria::truncate();
        Siswa::truncate();
        Kelas::truncate();
        User::truncate();
        Role::truncate();
    }
}
