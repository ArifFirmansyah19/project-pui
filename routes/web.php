<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
  AdminController,
  ArticleController,
  DashboardController,
  KegiatanController,
  KontakController,
  LoginController,
  MuseumController,
  PersebaranUmkmController,
  ProfilController,
  SumberDayaController,
  TimController
};



// =====> Route Pengguna Website PUI GEMAR

// Dashboard
Route::get('/', [DashboardController::class, 'indexWeb'])->name('dashboard-website')->middleware('guest');

// Login dan Forgot Password
Route::middleware('guest')->group(function () {
  Route::get('/login', [LoginController::class, 'index'])->name('login');
  Route::post('/login', [LoginController::class, 'authenticate']);
  Route::get('/forgot-password', [LoginController::class, 'forgot_password'])->name('forgot-password');
  Route::post('/forgot-password-act', [LoginController::class, 'forgot_password_act'])->name('forgot-password-act');
  Route::get('/validasi-forgot-password/{token}', [LoginController::class, 'validasi_forgot_password'])->name('validasi-forgot-password');
  Route::post('/validasi-forgot-password-act', [LoginController::class, 'validasi_forgot_password_act'])->name('validasi-forgot-password-act');
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Profil Pengguna
Route::middleware('guest')->prefix('profil')->group(function () {
  Route::get('/sejarah', [ProfilController::class, 'sejarah'])->name('sejarah');
  Route::get('/visimisi', [ProfilController::class, 'visimisi'])->name('visimisi');
  Route::get('/struktur-organisasi', [ProfilController::class, 'struktur_organisasi'])->name('struktur-organisasi');
});

// Tim
Route::middleware('guest')->prefix('tim')->group(function () {
  Route::get('/', [TimController::class, 'tim'])->name('tim');
  Route::get('/detail-anggota/{id}', [TimController::class, 'detail_tim'])->name('tim-detail');
});

// Artikel
Route::middleware('guest')->prefix('artikel')->group(function () {
  Route::get('/', [ArticleController::class, 'index'])->name('artikel');
  Route::get('/detail-artikel/{id}', [ArticleController::class, 'detail_article'])->name('artikel-detail');
  Route::post('/komentar-artikel/store', [ArticleController::class, 'store_comment_artikel'])->name('store.komentar-artikel');
});

// Kegiatan
Route::prefix('kegiatan')->group(function () {
  Route::get('/', [KegiatanController::class, 'index'])->name('kegiatan');
  Route::get('/detail-kegiatan/{id}', [KegiatanController::class, 'kegiatan_detail'])->name('detail-kegiatan');
  Route::post('/komentar-kegiatan/store', [KegiatanController::class, 'store_comment_kegiatan'])->name('store.komentar-kegiatan');
});

// Persebaran UMKM
Route::middleware('guest')->prefix('persebaran')->group(function () {
  Route::get('/', [SumberDayaController::class, 'peta_persebaran'])->name('peta-persebaran');
  Route::get('/detail-umkm/{id}', [SumberDayaController::class, 'detail_umkm'])->name('detail-umkm');
  Route::get('/detail-desa/{id}', [SumberDayaController::class, 'detail_potensi_desa'])->name('detail-potensi-desa');
});

// Museum
Route::prefix('museum')->group(function () {
  Route::get('/', [MuseumController::class, 'index'])->name('museum');
  Route::get('/allJenisKeragaman/{jenis_keragaman}', [MuseumController::class, 'all_jenis_keragaman'])->name('all-jenis-keragaman');
  Route::get('/detailDataKeragaman/{id}', [MuseumController::class, 'detail_data_keragaman'])->name('detail-data-keragaman');
});

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');



// =====> Route Admin Website PUI GEMAR

// Admin Dashboard and Profile Routes
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
  Route::get('/', [DashboardController::class, 'index_admin'])->name('admin');
  Route::get('/profil-admin', [AdminController::class, 'profile_admin'])->name('profiladmin');
  Route::get('/edit-profil-admin', [AdminController::class, 'edit_profile_admin'])->name('editprofil');
  Route::post('/update-profil-admin', [AdminController::class, 'update_profile_admin'])->name('updateprofil');
  Route::get('/edit-password-admin', [AdminController::class, 'edit_password_admin'])->name('editpassword');
  Route::post('/update-password-admin', [AdminController::class, 'update_password_admin'])->name('updatepassword');
});

// Admin Sejarah and Visi Misi Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
  Route::get('/sejarah', [ProfilController::class, 'index_admin'])->name('sejarah');
  Route::prefix('visimisi')->group(function () {
    Route::get('/', [ProfilController::class, 'index_visimisi'])->name('visimisi');
    Route::get('/create', [ProfilController::class, 'create_visimisi'])->name('create-visimisi');
    Route::post('/store', [ProfilController::class, 'store_visimisi'])->name('store-visimisi');
    Route::get('/edit/{id}', [ProfilController::class, 'edit_visimisi'])->name('edit-visimisi');
    Route::post('/update/{id}', [ProfilController::class, 'update_visimisi'])->name('update-visimisi');
  });
});

// Admin Struktur Organisasi Routes
Route::prefix('admin/struktur-organisasi')->name('admin.')->middleware('auth')->group(function () {
  Route::get('/', [ProfilController::class, 'index_struktur_organisasi'])->name('SO');
  Route::get('/create', [ProfilController::class, 'create_struktur_organisasi'])->name('create-SO');
  Route::post('/store', [ProfilController::class, 'store_struktur_organisasi'])->name('store-SO');
  Route::get('/edit/{id}', [ProfilController::class, 'edit_struktur_organisasi'])->name('edit-SO');
  Route::post('/update/{id}', [ProfilController::class, 'update_struktur_organisasi'])->name('update-SO');
});

// Admin Tim Routes
Route::prefix('admin/tim')->name('admin.')->middleware('auth')->group(function () {
  Route::get('/', [TimController::class, 'index_admin'])->name('tim');
  Route::get('/create', [TimController::class, 'create_tim'])->name('create-tim');
  Route::post('/store', [TimController::class, 'store_tim'])->name('store-tim');
  Route::get('/edit/{id}', [TimController::class, 'edit_tim'])->name('edit-tim');
  Route::post('/update/{id}', [TimController::class, 'update_tim'])->name('update-tim');
  Route::post('/destroy/{id}', [TimController::class, 'destroy_tim'])->name('destroy-tim');
});

// Admin Divisi Routes
Route::prefix('admin/divisi')->name('admin.')->middleware('auth')->group(function () {
  Route::get('/create', [TimController::class, 'create_divisi'])->name('create-divisi');
  Route::post('/store', [TimController::class, 'store_divisi'])->name('store-divisi');
  Route::post('/destroy/{id}', [TimController::class, 'destroy_divisi'])->name('destroy-divisi');
});

// Admin Jabatan Routes
Route::prefix('admin/jabatan')->name('admin.')->middleware('auth')->group(function () {
  Route::get('/create', [TimController::class, 'create_jabatan'])->name('create-jabatan');
  Route::post('/store', [TimController::class, 'store_jabatan'])->name('store-jabatan');
  Route::post('/destroy/{id}', [TimController::class, 'destroy_jabatan'])->name('destroy-jabatan');
});

// Admin Artikel Routes
Route::prefix('admin/artikel')->name('admin.')->middleware('auth')->group(function () {
  Route::get('/', [ArticleController::class, 'index_admin'])->name('artikel');
  Route::get('/create', [ArticleController::class, 'create_artikel'])->name('create-artikel');
  Route::post('/store', [ArticleController::class, 'store_artikel'])->name('store-artikel');
  Route::get('/detail/{id}', [ArticleController::class, 'detail_artikel_admin'])->name('detail-artikel');
  Route::post('/komentar/store', [ArticleController::class, 'store_comment_artikel'])->name('store.komentar-artikel');
  Route::get('/edit/{id}', [ArticleController::class, 'edit_artikel'])->name('edit-artikel');
  Route::post('/update/{id}', [ArticleController::class, 'update_artikel'])->name('update-artikel');
  Route::post('/destroy/{id}', [ArticleController::class, 'destroy_artikel'])->name('destroy-artikel');
});

// Admin Kegiatan Routes
Route::prefix('admin/kegiatan')->name('admin.')->middleware('auth')->group(function () {
  Route::get('/', [KegiatanController::class, 'index_admin'])->name('kegiatan');
  Route::get('/create', [KegiatanController::class, 'create_kegiatan'])->name('create-kegiatan');
  Route::post('/store', [KegiatanController::class, 'store_kegiatan'])->name('store-kegiatan');
  Route::get('/detail/{id}', [KegiatanController::class, 'detail_kegiatan_admin'])->name('detail-kegiatan');
  Route::post('/komentar/store', [KegiatanController::class, 'store_comment_kegiatan'])->name('store.komentar-kegiatan');
  Route::get('/edit/{id}', [KegiatanController::class, 'edit_kegiatan'])->name('edit-kegiatan');
  Route::post('/update/{id}', [KegiatanController::class, 'update_kegiatan'])->name('update-kegiatan');
  Route::post('/destroy/{id}', [KegiatanController::class, 'destroy_kegiatan'])->name('destroy-kegiatan');
});

// Admin - Persebaran UMKM
Route::prefix('admin/persebaran')->middleware('auth')->group(function () {
  Route::get('/', [PersebaranUmkmController::class, 'index_admin'])->name('admin.persebaran');

  // Desa dan Potensinya
  Route::prefix('desa')->group(function () {
    Route::get('create', [PersebaranUmkmController::class, 'create_desa_potensi'])->name('admin.create-desa');
    Route::post('store', [PersebaranUmkmController::class, 'store_desa_potensi'])->name('admin.store-desa');
    Route::get('detailDesa/{id}', [PersebaranUmkmController::class, 'detail_desa_admin'])->name('admin.detail-desa');
    Route::get('edit/{id}', [PersebaranUmkmController::class, 'edit_desa_potensi'])->name('admin.edit-desa');
    Route::post('update/{id}', [PersebaranUmkmController::class, 'update_desa_potensi'])->name('admin.update-desa');
  });

  // UMKM dan Produknya
  Route::prefix('umkm')->group(function () {
    Route::get('create', [PersebaranUmkmController::class, 'create_umkm'])->name('admin.create-umkm');
    Route::post('store', [PersebaranUmkmController::class, 'store_umkm'])->name('admin.store-umkm');
    Route::get('detailUMKM/{id}', [PersebaranUmkmController::class, 'detail_umkm_admin'])->name('admin.detail-umkm');
    Route::get('edit/{id}', [PersebaranUmkmController::class, 'edit_umkm'])->name('admin.edit-umkm');
    Route::post('update/{id}', [PersebaranUmkmController::class, 'update_umkm'])->name('admin.update-umkm');
    Route::post('destroy/{id}', [PersebaranUmkmController::class, 'destroy_umkm'])->name('admin.destroy-umkm');
  });
});

// Admin Museum Routes
Route::prefix('admin/museum')->name('admin.')->middleware('auth')->group(function () {
  Route::get('/', [MuseumController::class, 'index_museum'])->name('museum');
  Route::get('/create_jenisKeragaman', [MuseumController::class, 'create_jenis_keragaman'])->name('createJK');
  Route::post('/store_jenisKeragaman', [MuseumController::class, 'store_jenis_keragaman'])->name('storeJK');
  Route::get('/create_dataKeragaman', [MuseumController::class, 'create_data_keragaman'])->name('createDK');
  Route::post('/store_dataKeragaman', [MuseumController::class, 'store_data_keragaman'])->name('storeDK');
  Route::get('/edit_dataKeragaman/{id}', [MuseumController::class, 'edit_data_keragaman'])->name('editDK');
  Route::post('/update_dataKeragaman/{id}', [MuseumController::class, 'update_data_keragaman'])->name('updateDK');
  Route::post('/destroy_dataKeragaman/{id}', [MuseumController::class, 'destroy_data_keragaman'])->name('destroyDK');
});

// Admin - Kontak
Route::prefix('admin/kontak')->middleware('auth')->group(function () {
  Route::get('/', [KontakController::class, 'index_admin'])->name('admin.kontak');
  Route::get('create', [KontakController::class, 'create_kontak'])->name('admin.create-kontak');
  Route::post('store', [KontakController::class, 'store_kontak'])->name('admin.store-kontak');
  Route::get('edit/{id}', [KontakController::class, 'edit_kontak'])->name('admin.edit-kontak');
  Route::post('update/{id}', [KontakController::class, 'update_kontak'])->name('admin.update-kontak');
  Route::post('destroy/{id}', [KontakController::class, 'destroy_kontak'])->name('admin.destroy-kontak');
});