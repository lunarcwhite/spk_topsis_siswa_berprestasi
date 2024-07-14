<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kriteria;

class KelolaKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kriterias'] = Kriteria::orderBy('kode_kriteria', 'asc')->get();
        return view('kelola_kriteria.index')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|unique:kriterias,kode_kriteria',
            'kriteria' => 'required|unique:kriterias,kriteria',
            'bobot' => 'required|numeric'
        ]);

        try {
            Kriteria::create($request->input());
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal menambah data kriteria!')->withInput();
        }
        return redirect()->back()->with('success', 'Berhasil menambahkan kriteria');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kriteria = Kriteria::where('id', $id)->first();
        return $kriteria;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_kriteria' => 'required',
            'kriteria' => 'required',
            'bobot' => 'required|numeric'
        ]);

        try {
            Kriteria::where('id', $id)->update($request->except('_method', '_token'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal memperbarui data kriteria!')->withInput();
        }
        return redirect()->back()->with('success', 'Berhasil memperbarui kriteria');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Kriteria::where('id', $id)->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal menghapus kriteria!');
        }
        return redirect()->back()->with('success', 'Berhasil menghapus data kriteria');
    }
}
