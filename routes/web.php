<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetaPersebaranUmkmController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {return view('index');})->middleware('guest');

Route::get('/login', [LoginController::class, 'index']) -> middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index']);


Route::get('/peta', [PetaPersebaranUmkmController::class, 'index']);


Route::get('/sejarah', [ProfilController::class, 'sejarah']);
Route::get('/visimisi', [ProfilController::class, 'visimisi']);
Route::get('/tim', [ProfilController::class, 'timGemar']);





