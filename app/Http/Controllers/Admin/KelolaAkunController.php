<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class KelolaAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::whereNot('id', 1)->orderBy('role_id', 'asc')->get();
        $data['roles'] = Role::whereNot('id', 1)->get();
        return view('kelola_akun.index')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min_digits:8',
            'role_id' => 'required'
        ]);

        try {
            $data = $request->input();
            $data['password'] = bcrypt($request->input('password'));
            User::create($data);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal membuat akun!')->withInput();
        }
        return redirect()->back()->with('success', 'Akun berhasil dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->first();
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_method', '_token');
        if ($data['password'] != null) {
            $request->validate([
                'username' => 'required',
                'email' => 'required',
                'password' => 'min_digits:8',
                'role_id' => 'required'
            ]);
            $data['password'] = bcrypt($request->password);
        }else{
            $request->validate([
                'username' => 'required',
                'email' => 'required',
                'role_id' => 'required'
            ]);
            unset($data['password']);
        }

        try {
            User::where('id', $id)->update($data);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal memperbarui akun!')->withInput();
        }
        return redirect()->back()->with('success', 'Akun berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            User::where('id', $id)->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal menghapus akun!');
        }
        return redirect()->back()->with('success', 'Berhasil menghapus data akun');
    }
}
