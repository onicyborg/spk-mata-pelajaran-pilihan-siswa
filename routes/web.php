<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelolaDataSiswaController;
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
    Route::get('/admin/kelola-mapel', function(){
        return view('admin.kelola-mapel');
    });
    Route::get('/admin/kelola-guru', function(){
        return view('admin.kelola-guru');
    });
    Route::get('/admin/kelola-nilai', function(){
        return view('admin.kelola-nilai');
    });
});

Route::group(['middleware' => 'role:Siswa'], function () {
    Route::get('/siswa/dashboard', function () {
        return view('siswa.dashboard');
    });
});

Route::group(['middleware' => 'role:Guru'], function () {
    Route::get('/guru/dashboard', function () {
        return view('guru.dashboard');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
});
