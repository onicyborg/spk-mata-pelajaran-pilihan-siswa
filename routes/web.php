<?php

use App\Http\Controllers\AuthController;
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
