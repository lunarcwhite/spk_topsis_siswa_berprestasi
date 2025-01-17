<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class KelolaKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kelass'] = Kelas::orderBy('nama_kelas', 'asc')->get();
        $data['users'] = User::where('role_id', 2)->orderBy('username', 'asc')->get();
        return view('kelola_kelas.index')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas',
            'user_id' => 'required'
        ]);

        try {
            Kelas::create($request->input());
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()->back()->withErrors('Gagal menambah data kelas');
        }
        return redirect()->back()->with('success', 'Berhasil menambah data kelas');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $kelas = Kelas::where('id', $id)->first();
        return $kelas;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'user_id' => 'required'
        ]);

        try {
            Kelas::where('id', $id)->update($request->except('_method', '_token'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal memperbarui data kelas!');
        }
        return redirect()->back()->with('success', 'Berhasil memperbarui data kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        try {
            Kelas::where('id', $id)->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal menghapus kelas!');
        }
        return redirect()->back()->with('success', 'Berhasil menghapus data kelas');
    }
}
