<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Kelas;
use App\Models\Penilaian;
use App\Models\SubKriteria;
use Auth;

class PerankinganController extends Controller
{
    public function perankinganTernormalisasi()
    {
        $kelas = Kelas::waliKelas();
        $idKelas = $kelas->id;
        $data['matriks'] = Penilaian::menormalisasikanMatriks($idKelas);
        $data['siswas'] = Penilaian::getSiswa($idKelas);
        $data['kriterias'] = Penilaian::getKriteria();
        $data['kelas'] = $kelas;
        return view('perankingan.matriks_ternormalisasi')->with($data);
    }

    public function perankinganTernormalisasiTerbobot()
    {
        $kelas = Kelas::waliKelas();
        $idKelas = $kelas->id;
        $data['matriks'] = Penilaian::hitungNilaiNormalisasiTerbobot($idKelas);
        $data['siswas'] = Penilaian::getSiswa($idKelas);
        $data['kriterias'] = Penilaian::getKriteria();
        $data['kelas'] = $kelas;
        return view('perankingan.matriks_ternormalisasi_terbobot')->with($data);
    }

    public function nilaiPreferensi()
    {
        $kelas = Kelas::waliKelas();
        $idKelas = $kelas->id;
        $data['solusiIdeal'] = Penilaian::hitungJarakSolusiIdeal($idKelas);
        $data['siswas'] = Penilaian::getSiswa($idKelas);
        $data['nilaiPreferensi'] = Penilaian::hitungNilaiPreferensi($idKelas);
        $data['kelas'] = $kelas;
        // dd($data['solusiIdeal']);
        return view('perankingan.nilai_preferensi')->with($data);
    }
}
