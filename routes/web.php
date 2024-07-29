<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\KelolaKelasController;
use App\Http\Controllers\Admin\KelolaSiswaController;
use App\Http\Controllers\Admin\KelolaKriteriaController;
use App\Http\Controllers\Admin\KelolaSubKriteriaController;
use App\Http\Controllers\Admin\KelolaAkunController;
use App\Http\Controllers\Guru\PenilaianSiswaController;
use App\Http\Controllers\Guru\PerankinganController;
use App\Http\Controllers\KS\MonitoringController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });
    Route::prefix('/dashboard')->group(function () {
        Route::middleware('role:admin')->group(function () {
            Route::controller(KelolaKelasController::class)->group(function () {
                Route::get('/kelola_kelas', 'index')->name('kelola_kelas.index');
                Route::post('/kelola_kelas/tambah', 'store')->name('kelola_kelas.store');
                Route::delete('/kelola_kelas/{id}', 'destroy')->name('kelola_kelas.destroy');
                Route::get('/kelola_kelas/{id}/edit', 'edit')->name('kelola_kelas.edit');
                Route::put('/kelola_kelas/{id}', 'update')->name('kelola_kelas.update');
            });
            Route::controller(KelolaSiswaController::class)->group(function () {
                Route::get('/kelola_siswa/{kelas?}', 'index')->name('kelola_siswa.index');
                Route::post('/kelola_siswa/tambah', 'store')->name('kelola_siswa.store');
                Route::delete('/kelola_siswa/{id}', 'destroy')->name('kelola_siswa.destroy');
                Route::get('/kelola_siswa/{id}/edit', 'edit')->name('kelola_siswa.edit');
                Route::put('/kelola_siswa/{id}', 'update')->name('kelola_siswa.update');
            });
            Route::controller(KelolaKriteriaController::class)->group(function () {
                Route::get('/kelola_kriteria', 'index')->name('kelola_kriteria.index');
                Route::post('/kelola_kriteria/tambah', 'store')->name('kelola_kriteria.store');
                Route::delete('/kelola_kriteria/{id}', 'destroy')->name('kelola_kriteria.destroy');
                Route::get('/kelola_kriteria/{id}/edit', 'edit')->name('kelola_kriteria.edit');
                Route::put('/kelola_kriteria/{id}', 'update')->name('kelola_kriteria.update');
            });
            Route::controller(KelolaSubKriteriaController::class)->group(function () {
                Route::get('/kelola_sub_kriteria/{kriteria_id}', 'index')->name('kelola_sub_kriteria.index');
                Route::post('/kelola_sub_kriteria/tambah', 'store')->name('kelola_sub_kriteria.store');
                Route::delete('/kelola_sub_kriteria/{id}', 'destroy')->name('kelola_sub_kriteria.destroy');
                Route::get('/kelola_sub_kriteria/{id}/edit', 'edit')->name('kelola_sub_kriteria.edit');
                Route::put('/kelola_sub_kriteria/{id}', 'update')->name('kelola_sub_kriteria.update');
            });
            Route::controller(KelolaAkunController::class)->group(function () {
                Route::get('/kelola_akun', 'index')->name('kelola_akun.index');
                Route::post('/kelola_akun/tambah', 'store')->name('kelola_akun.store');
                Route::delete('/kelola_akun/{id}', 'destroy')->name('kelola_akun.destroy');
                Route::get('/kelola_akun/{id}/edit', 'edit')->name('kelola_akun.edit');
                Route::put('/kelola_akun/{id}', 'update')->name('kelola_akun.update');
            });
        });
        Route::middleware('role:Wali Kelas')->group(function () {
            Route::controller(PenilaianSiswaController::class)->group(function () {
                Route::get('/penilaian_siswa', 'index')->name('penilaian_siswa.index');
                Route::post('/penilaian_siswa', 'store')->name('penilaian_siswa.store');
            });
            Route::controller(PerankinganController::class)->group(function () {
                Route::get('/perankingan_ternormalisasi', 'perankinganTernormalisasi')->name('perankingan.perankinganTernormalisasi');
                Route::get('/perankingan_ternormalisasi_terbobot', 'perankinganTernormalisasiTerbobot')->name('perankingan.perankinganTernormalisasiTerbobot');
                Route::get('/hasil_solusi_ideal', 'hasilSolusiIdeal')->name('perankingan.hasilSolusiIdeal');
                Route::get('/nilai_preferensi', 'nilaiPreferensi')->name('perankingan.nilaiPreferensi');
                Route::get('/hasil_akhir', 'hasilAkhir')->name('perankingan.hasilAkhir');
            });
        });
        Route::middleware('role:Kepala Sekolah')->group(function () {
            Route::controller(MonitoringController::class)->group(function () {
                Route::get('/monitor_hasil_akhir', 'hasilAkhir')->name('monitoring.hasilAkhir');
            });
        });
    });
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
