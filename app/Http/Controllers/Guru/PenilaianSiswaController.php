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
    public function index()
    {
        $data['siswas'] = Siswa::where('kelas_id', Auth::user()->kelas->id)->get();
        $data['kelas'] = Kelas::where('user_id', Auth::user()->id)->pluck('nama_kelas')->first();
        $data['kriterias'] = Kriteria::orderBy('kode_kriteria', 'asc')->get();
        $data['nilais'] = Penilaian::all();
        return view('penilaian_siswa.index')->with($data);
    }

    public function store(Request $request)
    {
        $nilai = $request->nilai;
        $siswa = $request->siswa_id;

        foreach($request->kriteria_id as $index => $value){
            $penilaian = new Penilaian;
            try {
                $penilaian->storeNilai($siswa[$index], $value, $nilai[$index]);
            } catch (\Throwable $th) {
                // dd($th->getMessage());
                return redirect()->back()->withErrors('Gagal menyimpan nilai!')->withInput();
            }
        }
        return redirect()->back()->with('success', 'Berhasil menyimpan nilai!');
    }

}
