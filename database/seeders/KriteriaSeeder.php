<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_kriteria' => 'C1',
                'kriteria' => 'Peringkat Kelas',
                'bobot' => 5,
            ],
            [
                'kode_kriteria' => 'C2',
                'kriteria' => 'Kecakapan Bahasa',
                'bobot' => 4,
            ],
            [
                'kode_kriteria' => 'C3',
                'kriteria' => 'Keterampilan',
                'bobot' => 4,
            ],
            [
                'kode_kriteria' => 'C4',
                'kriteria' => 'Keaktifan',
                'bobot' => 3,
            ],
            [
                'kode_kriteria' => 'C5',
                'kriteria' => 'Sikap',
                'bobot' => 2,
            ],
        ];

        foreach ($data as $key => $value) {
            Kriteria::create($value);
        }
    }
}
