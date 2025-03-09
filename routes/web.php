<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
  AdminController,
  // ForgotPasswordController,
  ArticleController,
  DashboardController,
  KegiatanController,
  KontakController,
  LoginController,
  MuseumController,
  PersebaranUmkmController,
  ProfilController,
  SumberDayaController,
  TimController,
  HKIController,
};
use App\Http\Controllers\Auth\ForgotPasswordController;


// =====> Route Pengguna Website PUI GEMAR
// Dashboard
Route::get('/', [DashboardController::class, 'indexWeb'])->name('dashboard-website')->middleware('guest');

// Login dan Forgot Password
Route::middleware('guest')->group(function () {
  Route::get('/login', [LoginController::class, 'index'])->name('login');
  Route::post('/login', [LoginController::class, 'authenticate']);
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth', 'web');

// Profil Pengguna
Route::middleware('guest')->prefix('profil')->group(function () {
  Route::get('/sejarah', [ProfilController::class, 'sejarah'])->name('sejarah');
  Route::get('/visimisi', [ProfilController::class, 'visimisi'])->name('visimisi');
  Route::get('/struktur-organisasi', [ProfilController::class, 'struktur_organisasi'])->name('struktur-organisasi');
});

// Tim
Route::middleware('guest')->prefix('profil/tim')->group(function () {
  Route::get('/', [TimController::class, 'tim'])->name('tim');
  Route::get('/detail-tim/{id}', [TimController::class, 'detail_tim'])->name('tim-detail');
});

// Artikel
Route::middleware('guest')->prefix('sumberdaya/artikel')->group(function () {
  Route::get('/', [ArticleController::class, 'index'])->name('artikel');
  Route::get('/{articleId}/comments', [ArticleController::class, 'showComments'])->name('user-comments');
});

Route::post('/komentar-artikel/store', [ArticleController::class, 'store_comment_artikel'])->name('store.komentar-artikel');

// HKI
Route::middleware('guest')->prefix('sumberdaya/HKI')->group(function () {
  Route::get('/', [HKIController::class, 'index_HKI'])->name('HKI');
  Route::get('/detail-HKI/{id}', [HKIController::class, 'detail_HKI'])->name('HKI-detail');
});

// Kegiatan
Route::prefix('sumberdaya/kegiatan')->group(function () {
  Route::get('/', [KegiatanController::class, 'index'])->name('kegiatan');
  Route::get('/detail-kegiatan/{id}', [KegiatanController::class, 'kegiatan_detail'])->name('detail-kegiatan');
  Route::post('/komentar-kegiatan/store', [KegiatanController::class, 'store_comment_kegiatan'])->name('store.komentar-kegiatan');
});

// Persebaran UMKM
Route::middleware('guest')->prefix('sumberdaya/persebaran')->group(function () {
  Route::get('/', [SumberDayaController::class, 'peta_persebaran'])->name('peta-persebaran');
  Route::get('/detail-umkm/{umkm_id}/kecamatan/{kecamatan_id}/detail', [SumberDayaController::class, 'detail_umkm'])->name('detail-umkm');
  Route::get('/detail-kecamatan/{kecamatan_id}/potensi/{potensi_id}/detail', [SumberDayaController::class, 'detail_potensi_kecamatan'])->name('detail-potensi-kecamatan');
});



// Museum
Route::prefix('museum')->group(function () {
  Route::get('/', [MuseumController::class, 'index'])->name('museum');
  Route::get('/allJenisKeragaman/{jenis_keragaman}', [MuseumController::class, 'all_jenis_keragaman'])->name('all-jenis-keragaman');
  Route::get('/detailGeopark', [MuseumController::class, 'detail_geopark'])->name('detail-geopark');
  Route::get('/detailDataKeragaman/{id}', [MuseumController::class, 'detail_data_keragaman'])->name('detail-data-keragaman');
});

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');


// =====> Route Admin Website PUI GEMAR

// Admin Dashboard and Profile Routes
Route::prefix('dashboard')->name('dashboard.')->middleware('auth', 'web')->group(function () {
  Route::get('/', [DashboardController::class, 'index_admin'])->name('admin');
  Route::get('/edit-profil-admin', [AdminController::class, 'edit_profile_admin'])->name('editprofil');
  Route::post('/update-profil-admin', [AdminController::class, 'update_profile_admin'])->name('updateprofil');
});

// Admin Sejarah and Visi Misi Routes
Route::prefix('admin')->name('admin.')->middleware('auth', 'web')->group(function () {
  Route::prefix('sejarah')->group(function () {
    Route::get('/', [ProfilController::class, 'index_sejarah'])->name('sejarah');
    Route::get('/create', [ProfilController::class, 'create_sejarah'])->name('create-sejarah');
    Route::post('/store', [ProfilController::class, 'store_sejarah'])->name('store-sejarah');
    Route::get('/edit/{id}', [ProfilController::class, 'edit_sejarah'])->name('edit-sejarah');
    Route::post('/update/{id}', [ProfilController::class, 'update_sejarah'])->name('update-sejarah');
  });

  Route::prefix('visimisi')->group(function () {
    Route::get('/', [ProfilController::class, 'index_visimisi'])->name('visimisi');
    Route::get('/create', [ProfilController::class, 'create_visimisi'])->name('create-visimisi');
    Route::post('/store', [ProfilController::class, 'store_visimisi'])->name('store-visimisi');
    Route::get('/edit/{id}', [ProfilController::class, 'edit_visimisi'])->name('edit-visimisi');
    Route::post('/update/{id}', [ProfilController::class, 'update_visimisi'])->name('update-visimisi');
  });
});

// Admin Struktur Organisasi Routes
Route::prefix('admin/struktur-organisasi')->name('admin.')->middleware('auth', 'web')->group(function () {
  Route::get('/', [ProfilController::class, 'index_struktur_organisasi'])->name('SO');
  Route::get('/create', [ProfilController::class, 'create_struktur_organisasi'])->name('create-SO');
  Route::post('/store', [ProfilController::class, 'store_struktur_organisasi'])->name('store-SO');
  Route::get('/edit/{id}', [ProfilController::class, 'edit_struktur_organisasi'])->name('edit-SO');
  Route::post('/update/{id}', [ProfilController::class, 'update_struktur_organisasi'])->name('update-SO');
});

// Admin Tim Routes
Route::prefix('admin/tim')->name('admin.')->middleware('auth', 'web')->group(function () {
  Route::get('/', [TimController::class, 'index_admin'])->name('tim');
  Route::get('/detail-tim/{id}', [TimController::class, 'detailtim_admin'])->name('detail-tim-admin');
  Route::get('/create', [TimController::class, 'create_tim'])->name('create-tim');
  Route::post('/store', [TimController::class, 'store_tim'])->name('store-tim');
  Route::get('/edit/{id}', [TimController::class, 'edit_tim'])->name('edit-tim');
  Route::post('/update/{id}', [TimController::class, 'update_tim'])->name('update-tim');
  Route::post('/destroy/{id}', [TimController::class, 'destroy_tim'])->name('destroy-tim');
});

// Admin Divisi Routes
Route::prefix('admin/divisi')->name('admin.')->middleware('auth', 'web')->group(function () {
  Route::post('/store', [TimController::class, 'store_divisi'])->name('store-divisi');
});

// Admin Artikel Routes
Route::prefix('admin/artikel')->name('admin.')->middleware('auth', 'web')->group(function () {

  Route::get('/', [ArticleController::class, 'index_admin'])->name('artikel');
  Route::get('/create', [ArticleController::class, 'create_artikel'])->name('create-artikel');
  Route::post('/store', [ArticleController::class, 'store_artikel'])->name('store-artikel');


  Route::get('/{articleId}/comments', [ArticleController::class, 'getComments'])->name('admin-comments');
  Route::delete('/{articleId}/destroy/komentar/{commentId}', [ArticleController::class, 'destroy_comment_artikel'])->name('komentar.destroy');

  Route::get('/edit/{id}', [ArticleController::class, 'edit_artikel'])->name('edit-artikel');
  Route::post('/update/{id}', [ArticleController::class, 'update_artikel'])->name('update-artikel');
  Route::post('/{id}/delete', [ArticleController::class, 'destroy_artikel'])->name('destroy-artikel');
});

Route::post('/komentar/store', [ArticleController::class, 'store_comment_artikel'])->name('store.komentar-artikel');


// Admin HKI Routes
Route::prefix('admin/HKI')->name('admin.')->middleware('auth', 'web')->group(function () {
  Route::get('/', [HKIController::class, 'index_HKI_admin'])->name('HKI');
  Route::get('/create', [HKIController::class, 'create_HKI'])->name('create-HKI');
  Route::post('/store', [HKIController::class, 'store_HKI'])->name('store-HKI');
  Route::get('/edit/{id}', [HKIController::class, 'edit_HKI'])->name('edit-HKI');
  Route::post('/update/{id}', [HKIController::class, 'update_HKI'])->name('update-HKI');
  Route::post('/destroy/{id}', [HKIController::class, 'destroy_HKI'])->name('destroy-HKI');
});

// Admin Kegiatan Routes
Route::prefix('admin/kegiatan')->name('admin.')->middleware('auth', 'web')->group(function () {
  Route::get('/', [KegiatanController::class, 'index_admin'])->name('kegiatan');
  Route::get('/create', [KegiatanController::class, 'create_kegiatan'])->name('create-kegiatan');
  Route::post('/store', [KegiatanController::class, 'store_kegiatan'])->name('store-kegiatan');
  Route::get('/detail/{id}', [KegiatanController::class, 'detail_kegiatan_admin'])->name('detail-kegiatan');
  Route::post('/komentar/store', [KegiatanController::class, 'store_comment_kegiatan'])->name('store.komentar-kegiatan');
  Route::post('/komentar/destroy/{id}', [KegiatanController::class, 'destroy_comment_kegiatan'])->name('destroy.komentar-kegiatan');
  Route::get('/edit/{id}', [KegiatanController::class, 'edit_kegiatan'])->name('edit-kegiatan');
  Route::post('/update/{id}', [KegiatanController::class, 'update_kegiatan'])->name('update-kegiatan');
  Route::post('/destroy/{id}', [KegiatanController::class, 'destroy_kegiatan'])->name('destroy-kegiatan');
  Route::get('/{kegiatanId}/comments', [KegiatanController::class, 'getComments'])->name('admin-comments');
});

// Admin - Persebaran UMKM
Route::prefix('admin/persebaran')->middleware('auth', 'web')->group(function () {
  Route::get('/', [PersebaranUmkmController::class, 'index_admin'])->name('admin.persebaran');

  // Desa dan Potensinya
  Route::prefix('kecamatan')->group(function () {
    Route::post('store', [PersebaranUmkmController::class, 'store_kecamatan'])->name('admin.store-kecamatan');
    Route::post('/{id}/update', [PersebaranUmkmController::class, 'update_kecamatan'])->name('admin.update-kecamatan');
    Route::post('/{id}/delete', [PersebaranUmkmController::class, 'delete_kecamatan'])->name('admin.delete-kecamatan');
  });

  Route::prefix('potensi')->group(function () {
    Route::get('create/kecamatan/{kecamatanId}', [PersebaranUmkmController::class, 'create_potensi'])->name('admin.create-potensi');
    Route::post('store', [PersebaranUmkmController::class, 'store_potensi'])->name('admin.store-potensi');
    Route::get('kecamatan/{kecamatan_id}/potensi/{potensi_id}/detail', [PersebaranUmkmController::class, 'detail_potensi_admin'])->name('admin.detail-potensi');
    Route::get('edit/kecamatan/{kecamatan_id}/{potensi_id}', [PersebaranUmkmController::class, 'edit_potensi'])->name('admin.edit-potensi');
    Route::post('update/kecamatan/{kecamatan_id}/{potensi_id}', [PersebaranUmkmController::class, 'update_potensi'])->name('admin.update-potensi');
    Route::post('kecamatan/{kecamatan_id}/potensi/{potensi_id}/delete', [PersebaranUmkmController::class, 'delete_potensi'])->name('admin.delete-potensi');
  });


  // UMKM dan Produknya
  Route::prefix('umkm')->group(function () {
    Route::get('create/kecamatan/{kecamatanId}', [PersebaranUmkmController::class, 'create_umkm'])->name('admin.create-umkm');
    Route::post('store', [PersebaranUmkmController::class, 'store_umkm'])->name('admin.store-umkm');
    Route::get('/{umkm_id}/kecamatan/{kecamatan_id}/detail', [PersebaranUmkmController::class, 'detail_umkm_admin'])->name('admin.detail-umkm');
    Route::get('edit/kecamatan/{kecamatan_id}/{umkm_id}', [PersebaranUmkmController::class, 'edit_umkm'])->name('admin.edit-umkm');
    Route::post('update/kecamatan/{kecamatan_id}/{umkm_id}', [PersebaranUmkmController::class, 'update_umkm'])->name('admin.update-umkm');
    Route::post('destroy/kecamatan/{kecamatan_id}/{umkm_id}', [PersebaranUmkmController::class, 'destroy_umkm'])->name('admin.destroy-umkm');
  });
});

// Admin Museum Routes
Route::prefix('admin/museum')->name('admin.')->middleware('auth', 'web')->group(function () {
  Route::get('/', [MuseumController::class, 'index_museum'])->name('museum');
  Route::get('/create_jenisKeragaman', [MuseumController::class, 'create_jenis_keragaman'])->name('createJK');
  Route::post('/store_jenisKeragaman', [MuseumController::class, 'store_jenis_keragaman'])->name('storeJK');
  Route::post('/destroy_jenisKeragaman/{id}', [MuseumController::class, 'destroy_jenis_keragaman'])->name('destroyJK');
  Route::get('/create_dataKeragaman', [MuseumController::class, 'create_data_keragaman'])->name('createDK');
  Route::post('/store_dataKeragaman', [MuseumController::class, 'store_data_keragaman'])->name('storeDK');
  Route::get('/edit_dataKeragaman/{id}', [MuseumController::class, 'edit_data_keragaman'])->name('editDK');
  Route::get('/edit_dataMuseum/{id}', [MuseumController::class, 'edit_museum_geopark'])->name('editMG');
  Route::post('/update_dataKeragaman/{id}', [MuseumController::class, 'update_data_keragaman'])->name('updateDK');
  Route::post('/update_dataMuseum/{id}', [MuseumController::class, 'update_museum_geopark'])->name('updateMG');
  Route::post('/destroy_dataKeragaman/{id}', [MuseumController::class, 'destroy_data_keragaman'])->name('destroyDK');

  Route::get('/editKontakMuseum/{id}', [MuseumController::class, 'edit_kontak_museum'])->name('editKM');
  Route::post('/updateKontakMuseum/{id}', [MuseumController::class, 'update_kontak_museum'])->name('updateKM');
});

// Admin - Kontak
Route::prefix('admin/kontak')->middleware('auth', 'web')->group(function () {
  Route::get('/', [KontakController::class, 'index_admin'])->name('admin.kontak');
  Route::get('create', [KontakController::class, 'create_kontak'])->name('admin.create-kontak');
  Route::post('store', [KontakController::class, 'store_kontak'])->name('admin.store-kontak');
  Route::get('edit/{id}', [KontakController::class, 'edit_kontak'])->name('admin.edit-kontak');
  Route::post('update/{id}', [KontakController::class, 'update_kontak'])->name('admin.update-kontak');
  Route::post('destroy/{id}', [KontakController::class, 'destroy_kontak'])->name('admin.destroy-kontak');
});