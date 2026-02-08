<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Public\AuthController as PublicAuthController;
use App\Http\Controllers\Public\DokumenPublikController;
use App\Http\Controllers\Public\MasterDataController;
use App\Http\Controllers\Public\MatriksDipController;

Route::post('/auth/login', [PublicAuthController::class, 'login']);
Route::post('/track-visitor', 'VisitorController@track');


// Master Data
Route::get('/public/informasi/tahun', [MasterDataController::class, 'tahun']);
Route::get('/public/informasi/kategori', [MasterDataController::class, 'kategori']);
Route::get('/public/domisili', [MasterDataController::class, 'domisili']);
Route::get('/public/pekerjaan', [MasterDataController::class, 'pekerjaan']);
Route::get('/public/alasan-pengajuan', [MasterDataController::class, 'alasanPengajuan']);

Route::get('/public/informasi/kategori/{slug}', [DokumenPublikController::class, 'getByCategory']);
Route::get('/public/informasi/detail/{id}', [DokumenPublikController::class, 'show']);
Route::get('/public/informasi/download/{id}', [DokumenPublikController::class, 'download']);

Route::namespace('App\Http\Controllers\Public')->prefix('public')->group(function () {
    Route::apiResource('/slide-banner', 'SlideBannerController');
    Route::apiResource('/berita', 'BeritaController');
    Route::apiResource('/matriks-dip', 'MatriksDipController');
    Route::apiResource('/skpd', 'SkpdController');

    Route::get('/informasi/tahun/{tahun}', [MatriksDipController::class, 'tahun']);
});

// --- Rute Terproteksi (Sanctum) ---
Route::middleware('auth:sanctum')
    ->prefix('admin')
    ->namespace('App\Http\Controllers\Admin') 
    ->group(function () {

    // Auth & Profile
    // Tetap gunakan array untuk logout karena menggunakan PublicAuthController
    Route::post('/auth/logout', [PublicAuthController::class, 'logout']);
    
    Route::get('/user', function (Request $request) {
        return $request->user()->load('skpd:id_skpd,nm_skpd');
    });

    // Dashboard & Stats
    Route::apiResource('/dashboard/stats', 'DashboardController');
    Route::apiResource('/logs/login', 'LogLoginController');

    // Manajemen Konten
    Route::apiResource('berita', 'BeritaController');
    Route::apiResource('slide-banner', 'SlideBannerController');
    Route::apiResource('faq', 'FaqController');
    Route::apiResource('sop', 'SopController');

    // Layanan Informasi (Permohonan & Keberatan)
    Route::prefix('permohonan-informasi')->group(function () {
        Route::get('/', 'PermohonanInformasiController@index');
        Route::get('/{id}', 'PermohonanInformasiController@show');
        Route::put('/{id}', 'PermohonanInformasiController@update');
        Route::delete('/{id}', 'PermohonanInformasiController@destroy');
        Route::post('/{id}/disposisi', 'PermohonanInformasiController@disposisiStore');
        Route::post('/disposisi/{disposisiId}/respon', 'PermohonanInformasiController@responStore');
    });
    Route::apiResource('pengajuan-keberatan', 'PengajuanKeberatanController');

    // Dokumen & Publikasi
    Route::apiResource('dokumen-publik', 'DokumenPublikController');
    Route::apiResource('matriks-dip', 'MatriksDIPController');
    Route::apiResource('informasi', 'InformasiController');

    // Profil Lembaga & Pengaturan
    Route::apiResource('visi-misi', 'VisiMisiController');
    Route::apiResource('maklumat', 'MaklumatController');
    Route::apiResource('profil-ppid', 'ProfilPpidController');
    Route::apiResource('struktur-organisasi', 'StrukturOrganisasiController');
    Route::apiResource('tupoksi', 'TupoksiController');
    Route::apiResource('sambutan', 'SambutanController');
    Route::apiResource('profil-pemprov', 'ProfilPemprovController');
    
    // Konfigurasi & Master Data
    Route::apiResource('skpd', 'SkpdController');
    Route::apiResource('sosmed', 'SosmedController');
    Route::apiResource('footer-setting', 'FooterSettingController');
    Route::apiResource('integrated-service', 'IntegratedServiceController');

    // Master Data Groups
    Route::prefix('master-data')->group(function () {
        Route::apiResource('pekerjaan', 'MasterPekerjaanController');
        Route::apiResource('domisili', 'MasterDomisiliController');
        Route::apiResource('alasan-pengajuan', 'AlasanPengajuanController');
        Route::apiResource('bentuk-informasi', 'BentukInformasiController');
        Route::apiResource('kategori-informasi', 'KategoriInformasiController');
        Route::apiResource('tahun', 'MasterTahunController');
    });

    // Survey & Feedback
    Route::apiResource('survey-questions', 'SurveyQuestionController');
    // Untuk index manual (non-resource)
    Route::get('survey-responses', 'SurveyResponseController@index');
    Route::apiResource('ikphn', 'IkphnController');

    // Notifikasi
    Route::get('notifications', 'NotificationController@index');
    // Menggunakan ID untuk markAsRead
    Route::put('notifications/{id}/read', 'NotificationController@markAsRead');

});