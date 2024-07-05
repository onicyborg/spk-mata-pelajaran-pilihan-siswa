<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\KelolaDataSiswaController;
use App\Http\Controllers\KelolaGuruController;
use App\Http\Controllers\KelolaMapelController;
use App\Http\Controllers\KelolaNilaiController;
use App\Http\Controllers\KelolaProfileController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'role:Admin'], function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/admin/kelola-siswa', [KelolaDataSiswaController::class, 'index']);
    Route::post('/admin/add-siswa', [KelolaDataSiswaController::class, 'store']);
    Route::put('/admin/update-siswa/{id}', [KelolaDataSiswaController::class, 'update']);
    Route::delete('/admin/delete-siswa/{id}', [KelolaDataSiswaController::class, 'destroy']);
    Route::put('/admin/reset-password-siswa/{id}', [KelolaDataSiswaController::class, 'reset_password']);

    Route::get('/admin/kelola-mapel', [KelolaMapelController::class, 'index']);
    Route::post('/admin/add-mapel', [KelolaMapelController::class, 'store']);
    Route::put('/admin/update-mapel/{id}', [KelolaMapelController::class, 'update']);
    Route::delete('/admin/delete-mapel/{id}', [KelolaMapelController::class, 'destroy']);

    Route::get('/admin/kelola-guru', [KelolaGuruController::class, 'index']);
    Route::post('/admin/add-guru', [KelolaGuruController::class, 'store']);
    Route::put('/admin/update-guru/{id}', [KelolaGuruController::class, 'update']);
    Route::delete('/admin/delete-guru/{id}', [KelolaGuruController::class, 'destroy']);
    Route::put('/admin/reset-password-guru/{id}', [KelolaGuruController::class, 'reset_password']);

    Route::get('/admin/kelola-nilai', [KelolaNilaiController::class, 'index']);
    Route::get('/admin/penilaian-siswa/{id}', [KelolaNilaiController::class, 'detail_nilai']);
    Route::post('/admin/input-nilai', [KelolaNilaiController::class, 'store_nilai']);
    Route::put('/admin/update-nilai/{id}', [KelolaNilaiController::class, 'update_nilai']);
});

Route::group(['middleware' => 'role:Siswa'], function () {
    Route::get('/siswa/dashboard', function () {
        return view('siswa.dashboard');
    });
    Route::get('/siswa/daftar-jurusan', function(){
        return view('siswa.daftar-jurusan');
    });
    Route::get('/siswa/daftar-kepribadian', function(){
        return view('siswa.daftar-kepribadian');
    });
    Route::get('/siswa/nilai-siswa', [SiswaController::class, 'nilai_siswa']);
    Route::get('/siswa/ketertarikan', [SiswaController::class, 'ketertarikan']);
    Route::post('/siswa/ubah-jurusan', [SiswaController::class, 'ubah_jurusan']);
    Route::post('/siswa/ubah-mapel-fav', [SiswaController::class, 'ubah_mapel_fav']);

    Route::get('/siswa/hasil/{id}', [HasilController::class, 'hasil']);
});

Route::group(['middleware' => 'role:Guru'], function () {
    Route::get('/guru/dashboard', function () {
        return view('guru.dashboard');
    });

    Route::get('/guru/kelola-nilai', [KelolaNilaiController::class, 'index']);
    Route::get('/guru/penilaian-siswa/{id}', [KelolaNilaiController::class, 'detail_nilai']);
    Route::post('/guru/input-nilai', [KelolaNilaiController::class, 'store_nilai']);
    Route::put('/guru/update-nilai/{id}', [KelolaNilaiController::class, 'update_nilai']);

    Route::get('/guru/daftar-hasil-siswa', [HasilController::class, 'index']);
    Route::get('/guru/daftar-hasil-siswa/{id}', [HasilController::class, 'hasil']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [KelolaProfileController::class, 'index']);
    Route::put('/update-profile', [KelolaProfileController::class, 'update']);
    Route::put('/ubah-password', [KelolaProfileController::class, 'ubah_password']);
    Route::post('/update-foto-profile', [KelolaProfileController::class, 'avatar']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
