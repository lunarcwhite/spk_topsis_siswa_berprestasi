<?php

namespace App\Http\Controllers\KS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Penilaian;

class MonitoringController extends Controller
{
    public function hasilAkhir($kelas)
    {
        $data['nilaiPreferensi'] = Penilaian::hitungNilaiPreferensi();

        $data['kelass'] = Kelas::orderBy('nama_kelas', 'asc')->get();
        $data['siswas'] = Siswa::filterSiswaPerkelas($kelas);
        $data['nama_kelas'] = Kelas::where('id', $kelas)->first();
        $data['kelasPertama'] = Kelas::first();
        $data['perankingan'] = Penilaian::perankingan($kelas);
        // dd($data['perankingan']);
        return view('monitoring.hasil_akhir')->with($data);
    }
}
