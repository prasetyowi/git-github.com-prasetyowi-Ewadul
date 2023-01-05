<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\JenisPengaduanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\KaryawanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth', [AuthController::class, 'index']);
Route::get('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/login_admin', [AuthController::class, 'login_admin']);
Route::post('/auth/proses_login', [AuthController::class, 'proses_login']);
Route::get('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/proses_register', [AuthController::class, 'proses_register']);
Route::get('/auth/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/pengaduan', [PengaduanController::class, 'index']);
Route::get('/pengaduan/edit', [PengaduanController::class, 'edit']);
Route::get('/pengaduan/detail', [PengaduanController::class, 'detail']);
Route::get('/pengaduan/get_pengaduan_by_filter', [PengaduanController::class, 'get_pengaduan_by_filter']);
Route::get('/pengaduan/get_pengaduan_today', [PengaduanController::class, 'get_pengaduan_today']);
Route::get('/pengaduan/form', [PengaduanController::class, 'form']);
Route::post('/pengaduan/store', [PengaduanController::class, 'store']);
Route::post('/pengaduan/update', [PengaduanController::class, 'update']);
Route::post('/pengaduan/update_pengaduan_kemarin', [PengaduanController::class, 'update_pengaduan_kemarin']);
Route::post('/pengaduan/get_kecamatan_by_kota', [PengaduanController::class, 'get_kecamatan_by_kota']);
Route::post('/pengaduan/get_kelurahan_by_kota_kecamatan', [PengaduanController::class, 'get_kelurahan_by_kota_kecamatan']);
Route::post('/pengaduan/get_kodepos_by_kota_kecamatan_kelurahan', [PengaduanController::class, 'get_kodepos_by_kota_kecamatan_kelurahan']);

Route::get('/jenispengaduan', [JenisPengaduanController::class, 'index']);
Route::get('/jenispengaduan/get_jenis_pengaduan', [JenisPengaduanController::class, 'get_jenis_pengaduan']);
Route::get('/jenispengaduan/get_jenis_pengaduan_by_id', [JenisPengaduanController::class, 'get_jenis_pengaduan_by_id']);
Route::post('/jenispengaduan/store', [JenisPengaduanController::class, 'store']);
Route::get('/jenispengaduan/edit', [JenisPengaduanController::class, 'edit']);
Route::post('/jenispengaduan/update', [JenisPengaduanController::class, 'update']);
Route::post('/jenispengaduan/delete', [JenisPengaduanController::class, 'delete']);

Route::post('/notifikasi/update_lihat_notifikasi', [NotifikasiController::class, 'update_lihat_notifikasi']);

Route::get('/karyawan', [KaryawanController::class, 'index']);
Route::get('/karyawan/get_pengguna', [KaryawanController::class, 'get_pengguna']);
Route::get('/karyawan/get_pengguna_by_id', [KaryawanController::class, 'get_pengguna_by_id']);
Route::post('/karyawan/store', [KaryawanController::class, 'store']);
Route::get('/karyawan/edit', [KaryawanController::class, 'edit']);
Route::post('/karyawan/update', [KaryawanController::class, 'update']);
