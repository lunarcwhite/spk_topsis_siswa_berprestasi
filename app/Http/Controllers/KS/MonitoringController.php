<?php

namespace App\Http\Controllers\KS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Penilaian;

class MonitoringController extends Controller
{
    public function hasilAkhir()
    {
        $dump = [];
        $kelas = Kelas::all();
        foreach ($kelas as $value) {
            $temp = 0;
            $index = 0;
            $ranking = Penilaian::perankingan($value->id);

            foreach ($ranking as $key => $nilai) {
                if ($nilai >= $temp) {
                    $temp = $nilai;
                    $index = $key;
                }
            }
            array_push($dump, [$index, $temp]);

        }
        $data['ranking'] = $dump;
        $data['siswas'] = Siswa::all();

        return view('monitoring.hasil_akhir')->with($data);
    }
}
