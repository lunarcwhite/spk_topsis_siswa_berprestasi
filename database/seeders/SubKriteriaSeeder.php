<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubKriteria;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kriteria_id' => 1,
                'batas_atas' => 2,
                'batas_bawah' => 1,
                'nilai' => 4
            ],
            [
                'kriteria_id' => 1,
                'batas_atas' => 4,
                'batas_bawah' => 3,
                'nilai' => 3
            ],
            [
                'kriteria_id' => 1,
                'batas_atas' => 6,
                'batas_bawah' => 5,
                'nilai' => 2
            ],
            [
                'kriteria_id' => 2,
                'batas_atas' => 100,
                'batas_bawah' => 90,
                'nilai' => 4
            ],
            [
                'kriteria_id' => 2,
                'batas_atas' => 89,
                'batas_bawah' => 80,
                'nilai' => 3
            ],
            [
                'kriteria_id' => 2,
                'batas_atas' => 79,
                'batas_bawah' => 70,
                'nilai' => 2
            ],
            [
                'kriteria_id' => 3,
                'batas_atas' => 100,
                'batas_bawah' => 90,
                'nilai' => 4
            ],
            [
                'kriteria_id' => 3,
                'batas_atas' => 89,
                'batas_bawah' => 80,
                'nilai' => 3
            ],
            [
                'kriteria_id' => 3,
                'batas_atas' => 79,
                'batas_bawah' => 70,
                'nilai' => 2
            ],
            [
                'kriteria_id' => 4,
                'batas_atas' => 100,
                'batas_bawah' => 90,
                'nilai' => 4
            ],
            [
                'kriteria_id' => 4,
                'batas_atas' => 89,
                'batas_bawah' => 80,
                'nilai' => 3
            ],
            [
                'kriteria_id' => 4,
                'batas_atas' => 79,
                'batas_bawah' => 70,
                'nilai' => 2
            ],
            [
                'kriteria_id' => 5,
                'batas_atas' => 100,
                'batas_bawah' => 90,
                'nilai' => 4
            ],
            [
                'kriteria_id' => 5,
                'batas_atas' => 89,
                'batas_bawah' => 80,
                'nilai' => 3
            ],
            [
                'kriteria_id' => 5,
                'batas_atas' => 79,
                'batas_bawah' => 70,
                'nilai' => 2
            ],
        ];

        foreach($data as $value){
            SubKriteria::create($value);
        }
    }
}
