<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Kriteria;
use App\Models\Penilaian;

class PenilaianSiswaController extends Controller
{

    protected function getUserId()
    {
        if (Auth::check()) {
            return Auth::user()->id;
        }else{
            return redirect()->route('login')->withErrors('Silahkan login terlebih dahulu');
        }
    }
    protected function getKelasId()
    {
        if (Auth::check()) {
            return Kelas::where('user_id', $this->getUserId())->first();
        }else{
            return redirect()->route('login')->withErrors('Silahkan login terlebih dahulu');
        }
    }

    function getNilai($siswa, $kriteria, $nilai)
    {
        $nilai_siswa = Penilaian::where('siswa_id', $siswa)->where('kriteria_id', $kriteria)->first();
        if($nilai_siswa == null){
            Penilaian::create([
                'siswa_id' => $siswa,
                'kriteria_id' => $kriteria,
                'nilai' => $nilai
            ]);
        }elseif($nilai_siswa->nilai != $nilai){
            Penilaian::where('siswa_id', $siswa)->where('kriteria_id', $kriteria)->update([
                'nilai' => $nilai
            ]);
        }
        return 0;
        
    }

    public function index()
    {
        $data['siswas'] = Siswa::where('kelas_id', $this->getKelasId()->id)->get();
        $data['kelas'] = $this->getKelasId()->nama_kelas;
        $data['kriterias'] = Kriteria::orderBy('kode_kriteria', 'asc')->get();
        $data['nilais'] = Penilaian::all();
        return view('penilaian_siswa.index')->with($data);
    }

    public function store(Request $request)
    {
        $nilai = $request->nilai;
        $siswa = $request->siswa_id;

        foreach($request->kriteria_id as $index => $value){
            try {
                $this->getNilai($siswa[$index], $value, $nilai[$index]);
            } catch (\Throwable $th) {
                // dd($th->getMessage());
                return redirect()->back()->withErrors('Gagal menyimpan nilai!')->withInput();
            }
        }
        return redirect()->back()->with('success', 'Berhasil menyimpan nilai!');
    }

}
