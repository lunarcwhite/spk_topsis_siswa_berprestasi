<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubKriteria;
use App\Models\Kriteria;

class KelolaSubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $data['subKriterias'] = SubKriteria::where('kriteria_id', $id)->get();
        $data['kriteria'] = Kriteria::where('id', $id)->first();
        return view('kelola_sub_kriteria.index')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'batas_atas' => 'required',
            'batas_bawah' => 'required',
            'nilai' => 'required',
            'kriteria_id' => 'required'
        ]);

        try {
            SubKriteria::create($request->input());
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal menambah subkriteria baru')->withInput();
        }
        return redirect()->back()->with('success', 'Berhasil menambah subkriteria baru');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subKriteria = SubKriteria::where('id', $id)->first();
        return $subKriteria;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'batas_atas' => 'required',
            'batas_bawah' => 'required',
            'nilai' => 'required',
            'kriteria_id' => 'required'
        ]);

        try {
            SubKriteria::where('id', $id)->update($request->except('_token', '_method'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal memperbarui subkriteria')->withInput();
        }
        return redirect()->back()->with('success', 'Berhasil memperbarui subkriteria');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            SubKriteria::where('id', $id)->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal menghapus subkriteria!');
        }
        return redirect()->back()->with('success', 'Berhasil menghapus data subkriteria');
    }
}
