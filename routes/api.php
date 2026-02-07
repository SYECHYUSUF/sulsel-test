<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Admin\{
    DashboardController, BeritaController, DokumenPublikController,
    PermohonanInformasiController, PengajuanKeberatanController, SkpdController,
    SopController, FaqController, IkphnController, SlideBannerController,
    VisiMisiController, MaklumatController, ProfilPpidController,
    StrukturOrganisasiController, TupoksiController, SambutanController,
    ProfilPemprovController, SosmedController, FooterSettingController,
    SurveyQuestionController, SurveyResponseController, NotificationController,
    MatriksDIPController, InformasiController, KategoriInformasiController,
    BentukInformasiController, AlasanPengajuanController, MasterPekerjaanController,
    MasterDomisiliController, MasterTahunController, IntegratedServiceController,
    LogLoginController
};

// --- Rute Publik ---
Route::post('/auth/login', [AuthController::class, 'login']);

// --- Rute Terproteksi (Sanctum) ---
Route::middleware('auth:sanctum')->group(function () {

    // Auth & Profile
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user()->load('skpd:id_skpd,nm_skpd');
    });

    // Dashboard & Stats
    Route::get('/dashboard/stats', [DashboardController::class, 'index']);
    Route::get('/logs/login', [LogLoginController::class, 'index']);

    // Manajemen Konten & Berita
    Route::apiResource('berita', BeritaController::class);
    Route::get('berita/{id}/edit', [BeritaController::class, 'edit']); // Untuk data form edit
    Route::apiResource('slide-banner', SlideBannerController::class);
    Route::apiResource('faq', FaqController::class);
    Route::apiResource('sop', SopController::class);

    // Layanan Informasi (Permohonan & Keberatan)
    Route::prefix('permohonan-informasi')->group(function () {
        Route::get('/', [PermohonanInformasiController::class, 'index']);
        Route::get('/{id}', [PermohonanInformasiController::class, 'show']);
        Route::put('/{id}', [PermohonanInformasiController::class, 'update']);
        Route::delete('/{id}', [PermohonanInformasiController::class, 'destroy']);
        Route::post('/{id}/disposisi', [PermohonanInformasiController::class, 'disposisiStore']);
        Route::post('/disposisi/{disposisiId}/respon', [PermohonanInformasiController::class, 'responStore']);
    });
    Route::apiResource('pengajuan-keberatan', PengajuanKeberatanController::class);

    // Dokumen & Publikasi
    Route::apiResource('dokumen-publik', DokumenPublikController::class);
    Route::apiResource('matriks-dip', MatriksDIPController::class);
    Route::apiResource('informasi', InformasiController::class);

    // Profil Lembaga & Pengaturan
    Route::apiResource('visi-misi', VisiMisiController::class);
    Route::apiResource('maklumat', MaklumatController::class);
    Route::apiResource('profil-ppid', ProfilPpidController::class);
    Route::apiResource('struktur-organisasi', StrukturOrganisasiController::class);
    Route::apiResource('tupoksi', TupoksiController::class);
    Route::apiResource('sambutan', SambutanController::class);
    Route::apiResource('profil-pemprov', ProfilPemprovController::class);
    
    // Konfigurasi & Master Data
    Route::apiResource('skpd', SkpdController::class);
    Route::apiResource('sosmed', SosmedController::class);
    Route::apiResource('footer-setting', FooterSettingController::class);
    Route::apiResource('integrated-service', IntegratedServiceController::class);

    // Master Data Groups (Mirip struktur web.php)
    Route::prefix('master-data')->group(function () {
        Route::apiResource('pekerjaan', MasterPekerjaanController::class);
        Route::apiResource('domisili', MasterDomisiliController::class);
        Route::apiResource('alasan-pengajuan', AlasanPengajuanController::class);
        Route::apiResource('bentuk-informasi', BentukInformasiController::class);
        Route::apiResource('kategori-informasi', KategoriInformasiController::class);
        Route::apiResource('tahun', MasterTahunController::class);
    });

    // Survey & Feedback
    Route::apiResource('survey-questions', SurveyQuestionController::class);
    Route::get('survey-responses', [SurveyResponseController::class, 'index']);
    Route::apiResource('ikphn', IkphnController::class);

    // Notifikasi
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::put('notifications/{id}/read', [NotificationController::class, 'markAsRead']);

});