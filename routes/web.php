<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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
