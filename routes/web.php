<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilAdminController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SumberDayaController;
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
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::get('/forgotpw', [LoginController::class, 'forgotPw']) ->name('login.forgotPw')-> middleware('guest');

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.admin')->middleware('auth');


Route::get('/sejarah', [ProfilController::class, 'sejarah'])->name('profil.sejarah');
Route::get('/visimisi', [ProfilController::class, 'visimisi'])->name('profil.visimisi');
Route::get('/struktur-organisasi', [ProfilController::class, 'StrukturOrganisasi'])->name('profil.struktur-organisasi');
Route::get('/tim', [ProfilController::class, 'timGemar'])->name('profil.tim');


Route::get('/sejarah-admin', [ProfilAdminController::class, 'adminSejarah'])->name('profiladmin.sejarah');
Route::get('/visimisi-admin', [ProfilAdminController::class, 'adminVisiMisi'])->name('profiladmin.visimisi');
Route::get('/struktur-organisasi-admin', [ProfilAdminController::class, 'adminStrukturOrganisasi'])->name('profiladmin.struktur-organisasi');
Route::get('/tim-admin', [ProfilAdminController::class, 'adminTimGemar'])->name('profiladmin.tim');


Route::get('/artikel', [SumberDayaController::class, 'artikel'])->name('sumberdaya.artikel');
Route::get('/kegiatan', [SumberDayaController::class, 'kegiatan'])->name('sumberdaya.kegiatan');
Route::get('/petapersebaran', [SumberDayaController::class, 'peta'])->name('sumberdaya.petapersebaran');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.kontak');


Route::get('/article', [ArticleController::class, 'index'])->name('article')->middleware('auth');
Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create')->middleware('auth');
Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store')->middleware('auth');
Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit')->middleware('auth');
Route::post('/article/update/{id}', [ArticleController::class, 'update'])->name('article.update')->middleware('auth');
Route::post('/article/destroy/{id}', [ArticleController::class, 'destroy'])->name('article.destroy')->middleware('auth');









