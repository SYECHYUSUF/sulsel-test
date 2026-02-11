<?php

use App\Http\Controllers\Admin\PengajuanKeberatanController;
use App\Http\Controllers\Admin\PermohonanInformasiController;
use App\Http\Controllers\Admin\SkpdVisiMisiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Public\AuthController as PublicAuthController;
use App\Http\Controllers\Public\BeritaController;
use App\Http\Controllers\Public\DokumenPublikController;
use App\Http\Controllers\Public\MasterDataController;
use App\Http\Controllers\Public\MatriksDipController;
use App\Http\Controllers\Public\SopController;

Route::post('/auth/login', [PublicAuthController::class, 'login']);
// Route::post('/track-visitor', 'VisitorController@track'); // Commented out if controller doesn't exist

// Master Data
Route::get('/public/informasi/tahun', [MasterDataController::class, 'tahun']);
Route::get('/public/informasi/kategori', [MasterDataController::class, 'kategori']);
Route::get('/public/domisili', [MasterDataController::class, 'domisili']);
Route::get('/public/pekerjaan', [MasterDataController::class, 'pekerjaan']);
Route::get('/public/alasan-pengajuan', [MasterDataController::class, 'alasanPengajuan']);
Route::get('/public/bentuk-informasi', [MasterDataController::class, 'bentukInformasi']);

Route::get('/public/informasi/pengadaan', [DokumenPublikController::class, 'pengadaan']);
Route::get('/public/informasi/tahun/{year}', [MatriksDipController::class, 'tahun']);
Route::get('/public/informasi/kategori/{slug}', [DokumenPublikController::class, 'getByCategory']);
Route::get('/public/informasi/detail/{id}', [DokumenPublikController::class, 'show']);
Route::get('/public/informasi/download/{id}', [DokumenPublikController::class, 'download']);

// Search Suggestions
Route::get('/dokumen-publik/search-suggestions', [DokumenPublikController::class, 'suggestions']);

// Berita terbaru
Route::get('/public/berita/latest', [BeritaController::class, 'latest']);

Route::
        namespace('App\Http\Controllers\Public')->prefix('public')->group(function () {
            Route::apiResource('/slide-banner', 'SlideBannerController');
            Route::apiResource('/berita', 'BeritaController');
            Route::apiResource('/matriks-dip', 'MatriksDipController');
            Route::apiResource('/skpd', 'SkpdController');
            Route::apiResource('/faq', 'FaqController');

    Route::apiResource('footer-setting', 'FooterSettingController');

    Route::get('/sop', [SopController::class, 'index']);
    Route::get('/sop/download', [SopController::class, 'download']);

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

    // Social Links
    Route::get('/social-links', 'SocialLinksController@index');

            Route::get('/infuserormasi/tahun/{tahun}', [MatriksDipController::class, 'tahun']);
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
        Route::apiResource('/dashboard', 'DashboardController');
        Route::apiResource('/logs/login', 'LogLoginController');

        Route::apiResource('/users', 'UserController');

        // Manajemen Konten
        Route::apiResource('berita', 'BeritaController');
        Route::apiResource('slide-banner', 'SlideBannerController');
        Route::apiResource('faq', 'FaqController');
        Route::apiResource('sop', 'SopController');

    // Layanan Informasi (Permohonan & Keberatan)
    // Route::prefix('permohonan-informasi')->name('admin.permohonan-informasi.')->group(function () {
    //     Route::get('/', 'PermohonanInformasiController@index')->name('index');
    //     Route::get('/{id}', 'PermohonanInformasiController@show')->name('show');
    //     Route::put('/{id}', 'PermohonanInformasiController@update')->name('update');
    //     Route::delete('/{id}', 'PermohonanInformasiController@destroy')->name('destroy');
    //     Route::post('/{id}/disposisi', 'PermohonanInformasiController@disposisiStore')->name('disposisi.store');
    //     Route::post('/disposisi/{disposisiId}/respon', 'PermohonanInformasiController@responStore')->name('respon.store');
    // });

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
        Route::apiResource('alasan-pengajuan', 'AlasanPengajuanController');
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
    // Menggunakan ID untuk markAsRead
    Route::put('notifications/{id}/read', 'NotificationController@markAsRead');
});