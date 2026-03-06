<?php

use App\Http\Controllers\Admin\PengajuanKeberatanController;
use App\Http\Controllers\Admin\PermohonanInformasiController;
use App\Http\Controllers\Admin\SkpdTupoksiController;
use App\Http\Controllers\Admin\SkpdVisiMisiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TokenController;

use App\Http\Controllers\Public\BeritaController;
use App\Http\Controllers\Public\DokumenPublikController;
use App\Http\Controllers\Public\MasterDataController;
use App\Http\Controllers\Public\MatriksDipController;
use App\Http\Controllers\Public\SopController;
use App\Http\Controllers\Public\StatusCheckController;
use App\Http\Controllers\Public\VisitorController;
use App\Http\Middleware\TokenMiddleware;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/track-visitor', [VisitorController::class, 'track']);

// Master Data
Route::get('/public/informasi/tahun', [MasterDataController::class, 'tahun']);
Route::get('/public/informasi/kategori', [MasterDataController::class, 'kategori']);
Route::get('/public/domisili', [MasterDataController::class, 'domisili']);
Route::get('/public/pekerjaan', [MasterDataController::class, 'pekerjaan']);
Route::get('/public/bentuk-informasi', [MasterDataController::class, 'bentukInformasi']);

Route::get('/public/informasi/pengadaan', [DokumenPublikController::class, 'pengadaan']);
Route::get('/public/informasi/tahun/{year}', [DokumenPublikController::class, 'getByYear']);
Route::get('/public/informasi/kategori/{slug}', [DokumenPublikController::class, 'getByCategory']);
Route::get('/public/informasi/detail/{id}', [DokumenPublikController::class, 'show']);
Route::get('/public/informasi/download/{id}', [DokumenPublikController::class, 'download']);

Route::get('/public/cek-status', [StatusCheckController::class, 'checkStatus']);

// Search Suggestions
Route::get('/dokumen-publik/search-suggestions', [DokumenPublikController::class, 'suggestions']);

// Berita terbaru
Route::get('/public/berita/latest', [BeritaController::class, 'latest']);

Route::post('refresh-token', [TokenController::class, 'refreshToken'])->middleware(TokenMiddleware::class);

Route::
        namespace('App\Http\Controllers\Public')->prefix('public')->group(function () {
            Route::apiResource('/slide-banner', 'SlideBannerController');
            Route::apiResource('/berita', 'BeritaController');
            Route::apiResource('/matriks-dip', 'MatriksDipController');
            Route::apiResource('/skpd', 'SkpdController');
            Route::apiResource('/faq', 'FaqController');

            Route::apiResource('footer-setting', 'FooterSettingController');

            Route::get('/sop', [SopController::class, 'index']);
            Route::get('/sop/download/{id}', [SopController::class, 'download']);

            Route::apiResource('/pengajuan-keberatan', 'PengajuanKeberatanController');

            Route::apiResource('/sosmed', 'SosmedController');
            Route::get('/permohonan-informasi/search', 'PermohonanInformasiController@search');
            Route::apiResource('/permohonan-informasi', 'PermohonanInformasiController');

            Route::get('/survey/questions', 'SurveyController@create');
            Route::post('/survey/store', 'SurveyController@store');
            Route::get('/survey/results', 'SurveyController@showResults');

            Route::get('/profil-pemprov', 'ProfilPemprovController@index');

            Route::prefix('profil')->group(function () {
                Route::get('ppid', 'ProfilController@ppid');
                Route::get('pemerintah', 'ProfilController@pemprov');
                Route::get('visi-misi', 'ProfilController@visiMisi');
                Route::get('tupoksi', 'ProfilController@tupoksi');
                Route::get('struktur-organisasi', 'ProfilController@strukturOrganisasi');
                Route::get('sambutan', 'ProfilController@sambutan');
                Route::get('maklumat', 'ProfilController@maklumat');
            });
        });

// --- Rute Terproteksi (Sanctum) ---
Route::middleware('auth:sanctum')
    ->prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->group(function () {

        Route::post('/auth/logout', [AuthController::class, 'logout']);

        Route::get('/user', function (Request $request) {
            return $request->user()->load('skpd:id_skpd,nm_skpd');
        });

        Route::get('/user/profile', function (Request $request) {
            return $request->user()->load('skpd:id_skpd,nm_skpd', 'lastLogin');
        });

        // Dashboard & Stats
        Route::apiResource('/dashboard', 'DashboardController');
        Route::apiResource('/logs/login', 'LogLoginController');

        Route::apiResource('/users', 'UserController');
        Route::post('/users/{id}/change-password', 'UserController@changePassword');

        // Manajemen Konten
        Route::apiResource('berita', 'BeritaController');
        Route::apiResource('slide-banner', 'SlideBannerController');
        Route::apiResource('faq', 'FaqController');
        Route::apiResource('sop', 'SopController');

        Route::apiResource('permohonan-informasi', 'PermohonanInformasiController');
        Route::prefix('permohonan-informasi')->group(function () {
            Route::post('{id}/disposisi', [PermohonanInformasiController::class, 'disposisiStore']);
            Route::post('disposisi/{disposisiId}/respon', [PermohonanInformasiController::class, 'responStore']);
        });

        // Resource route untuk index, show, update, destroy
        Route::apiResource('pengajuan-keberatan', 'PengajuanKeberatanController');

        // Route tambahan untuk fungsi spesifik di PengajuanKeberatanController
        Route::prefix('pengajuan-keberatan')->group(function () {
            // Route untuk Feedback
            Route::post('{id}/feedback', [PengajuanKeberatanController::class, 'storeFeedback'])->name('pengajuan-keberatan.storeFeedback');
            Route::get('{id}/feedback', [PengajuanKeberatanController::class, 'loadFeedback'])->name('pengajuan-keberatan.loadFeedback');

            // Route untuk Disposisi (Store ke banyak SKPD)
            Route::post('{id}/disposisi', [PengajuanKeberatanController::class, 'disposisiStore'])->name('pengajuan-keberatan.disposisi.store');

            // Route untuk Respon (Dari SKPD ke admin)
            Route::post('disposisi/{disposisiId}/respon', [PengajuanKeberatanController::class, 'responStore'])->name('pengajuan-keberatan.respon.store');
        });

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
        Route::get('/skpd/{id}/visi-misi', [SkpdVisiMisiController::class, 'show']);
        Route::put('/skpd/{id}/visi-misi', [SkpdVisiMisiController::class, 'update']);
        Route::get('/skpd/{id}/tupoksi', [SkpdTupoksiController::class, 'show']);
        Route::put('/skpd/{id}/tupoksi', [SkpdTupoksiController::class, 'update']);

        Route::apiResource('sosmed', 'SosmedController');
        Route::apiResource('footer-setting', 'FooterSettingController');
        Route::apiResource('integrated-service', 'IntegratedServiceController');
        Route::apiResource('ikphn', 'IkphnController');

        // Social Links Management
        Route::apiResource('sosmed', 'SosmedController');

        // Master Data Groups
        Route::prefix('master-data')->group(function () {
            Route::apiResource('pekerjaan', 'MasterPekerjaanController');
            Route::apiResource('domisili', 'MasterDomisiliController');
            Route::apiResource('bentuk-informasi', 'BentukInformasiController');
            Route::apiResource('kategori-informasi', 'KategoriInformasiController');
            Route::apiResource('tahun', 'MasterTahunController');
        });

        // Survey & Feedback
        Route::apiResource('survey-questions', 'SurveyQuestionController');
        // Untuk index manual (non-resource)
        Route::get('survey-responses', 'SurveyResponseController@index');

        // Notifikasi
        Route::get('notifications', 'NotificationController@index');
        Route::put('notifications/{id}/read', 'NotificationController@markAsRead');
        Route::post('notifications/mark-all-read', 'NotificationController@markAllAsRead');
        Route::delete('notifications/delete-all', 'NotificationController@deleteAll');
    });