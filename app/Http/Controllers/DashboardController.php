<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;

class DashboardController extends Controller
{
    public function index()
    {
        $data['siswa'] = Siswa::all()->count();
        $data['kelas'] = Kelas::all()->count();
        $data['user'] = User::whereNot('role_id', 1)->count();
        $data['kelasPertama'] = Kelas::first();
        return view('dashboard')->with($data);
    }
}
