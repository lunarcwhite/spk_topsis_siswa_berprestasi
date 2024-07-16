<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Kelas;

class KelolaSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($kelas = null)
    {
        $query = Siswa::query()->orderBy('nama', 'asc');

        $data['kelass'] = Kelas::orderBy('nama_kelas', 'asc')->get();
        $data['nama_kelas'] = Kelas::where('id', $kelas)->first();

        $data['siswas'] = Siswa::filterSiswaPerkelas($kelas);
        return view('kelola_siswa.index')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:siswas,nisn',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'kelas_id' => 'required'
        ]);

        try {
            Siswa::create($request->input());
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal menambah siswa')->withInput();
        }
        return redirect()->back()->with('success', 'Berhasil menambahkan siswa');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $siswa = Siswa::where('id', $id)->first();
        return $siswa;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'nisn' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'kelas_id' => 'required'
        ]);

        try {
            Siswa::where('id', $id)->update($request->except('_token', '_method'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->withErrors('Gagal memperbarui data siswa')->withInput();
        }
        return redirect()->back()->with('success', 'Berhasil memperbarui data siswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        try {
            Siswa::where('id', $id)->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal menghapus siswa!');
        }
        return redirect()->back()->with('success', 'Berhasil menghapus data siswa');
    }
}
