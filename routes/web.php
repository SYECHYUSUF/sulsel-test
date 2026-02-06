<?php

use App\Http\Controllers\Admin\AlasanPengajuanController;
use App\Http\Controllers\Admin\BentukInformasiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController as GuestBeritaController;
use App\Http\Controllers\DokumenPublikController as GuestDokumenPublikController;
use App\Http\Controllers\MatriksDipController as GuestMatriksDipController;
use App\Http\Controllers\SopController as GuestSopController;
use App\Http\Controllers\PengajuanKeberatanController as GuestPengajuanKeberatanController;
use App\Http\Controllers\PermohonanInformasiController as GuestPermohonanInformasiController;
use App\Http\Controllers\StatusCheckController;
use Illuminate\Cache\RateLimiting\Limit;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DokumenPublikController;
use App\Http\Controllers\Admin\PengajuanKeberatanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PermohonanInformasiController;
use App\Http\Controllers\Admin\SkpdController;
use App\Http\Controllers\Admin\SlideBannerController;
use App\Http\Controllers\Admin\SopController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FooterSettingController;
use App\Http\Controllers\Admin\IkphnController;
use App\Http\Controllers\Admin\IntegratedServiceController;
use App\Http\Controllers\Admin\KategoriInformasiController;
use App\Http\Controllers\Admin\LogLoginController;
use App\Http\Controllers\Admin\MaklumatController;
use App\Http\Controllers\Admin\MasterDataController;
use App\Http\Controllers\Admin\MasterDomisiliController;
use App\Http\Controllers\Admin\MasterPekerjaanController;
use App\Http\Controllers\Admin\MasterTahunController;
use App\Http\Controllers\Admin\MatriksDIPController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProfilPemprovController;
use App\Http\Controllers\Admin\ProfilPpidController;
use App\Http\Controllers\Admin\SambutanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SurveyQuestionController;
use App\Http\Controllers\Admin\SurveyResponseController;
use App\Http\Controllers\Admin\SosmedController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\Admin\TupoksiController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Api\Auth\ApiLoginController;
use App\Models\Setting;
use App\Models\Skpd;
use App\Models\MasterPekerjaan;
use App\Models\AlasanPengajuan;
use App\Models\BentukInformasi;
use App\Models\Berita;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

// Language Switcher
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return back();
});

Route::get('/api/dokumen-publik/search-suggestions', [GuestDokumenPublikController::class, 'suggestions']);

// Rate Limiter
RateLimiter::for('login', function ($request) {
    return Limit::perMinute(100)->by($request->ip());
});

// Group Track Visitors
Route::middleware(['track.visitors'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/contact', function () {
        return view('pages.contact');
    });

    // Profil Pages
    Route::get('/profil-ppid', function () {
        $profil = Profil::getByTipe('profil-ppid');
        return view('pages.profil.profil-ppid', compact('profil'));
    });
    Route::get('/sambutan', function () {
        $profil = Profil::getByTipe('sambutan');
        $recentNews = Berita::where('verify', 'y')
            ->orderBy('tgl_upload', 'desc')
            ->take(4)
            ->get();
        return view('pages.profil.sambutan', compact('recentNews', 'profil'));
    });
    Route::get('/struktur-organisasi', function () {
        $pdfPath = Setting::where('key', 'struktur_organisasi_path')->value('value');
        return view('pages.profil.struktur-organisasi', compact('pdfPath'));
    });
    Route::get('/visi-misi', function () {
        $profil = Profil::getByTipe('visi-misi');
        $recentNews = Berita::where('verify', 'y')
            ->orderBy('tgl_upload', 'desc')
            ->take(4)
            ->get();
        return view('pages.profil.visi-misi', compact('recentNews', 'profil'));
    });
    Route::get('/tupoksi', function () {
        $profil = Profil::getByTipe('tupoksi');
        return view('pages.profil.tupoksi', compact('profil'));
    });
    Route::get('/maklumat-pelayanan', function () {
        $profil = Profil::getByTipe('maklumat');
        return view('pages.profil.maklumat', compact('profil'));
    });
    Route::get('/profil-pemprov', function () {
        $profil = Profil::getByTipe('pemerintah');
        return view('pages.profil.pemerintah', compact('profil'));
    });

    Route::get('/ppid-pelaksana', function (Illuminate\Http\Request $request) {
        $search = $request->input('search');

        $query = Skpd::orderBy('nm_skpd', 'asc');

        // Apply search filter if search term exists
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nm_skpd', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('website', 'like', '%' . $search . '%');
            });
        }

        $ppidData = $query->paginate(12)->appends(['search' => $search]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($ppidData);
        }

        return view('pages.profil.ppid-pelaksana', compact('ppidData', 'search'));
    });

    Route::get('/ppid-pelaksana/{id}', function ($id) {
        $skpd = Skpd::where('id_skpd', $id)->firstOrFail();
        return view('pages.profil.ppid-pelaksana-detail', compact('skpd'));
    })->name('ppid-pelaksana.detail');

    // Berita Pages
    Route::get('/berita', [GuestBeritaController::class, 'index']);
    Route::get('/berita/{slug}', [GuestBeritaController::class, 'show'])->name('berita.show');

    // Informasi Publik Pages
    Route::get('/informasi-publik', [GuestMatriksDipController::class, 'index']);
    Route::get('/informasi-publik/tahun/{tahun}', [GuestMatriksDipController::class, 'tahun'])->name('informasi-publik.tahun');
    Route::get('/informasi-publik/2023', function () {
        return redirect()->route('informasi-publik.tahun', 2023);
    });
    Route::get('/informasi-publik/2024', function () {
        return redirect()->route('informasi-publik.tahun', 2024);
    });
    Route::get('/informasi-publik/2025', function () {
        return redirect()->route('informasi-publik.tahun', 2025);
    });
    Route::get('/informasi-publik/serta-merta', [GuestDokumenPublikController::class, 'sertaMerta']);
    Route::get('/informasi-publik/setiap-saat', [GuestDokumenPublikController::class, 'setiapSaat']);
    Route::get('/informasi-publik/daftar-informasi-dikecualikan', [GuestDokumenPublikController::class, 'dikecualikan']);
    Route::get('/informasi-publik/berkala', [GuestDokumenPublikController::class, 'berkala']);
    Route::get('/informasi-publik/pengadaan', [GuestMatriksDipController::class, 'pengadaan']);
    Route::get('/informasi-publik/detail/{id}', [GuestDokumenPublikController::class, 'show'])->name('informasi-publik.show');
    Route::get('/informasi-publik/download/{id}', [GuestDokumenPublikController::class, 'download'])->name('informasi-publik.download');

    // Layanan Pages
    Route::get('/layanan/permohonan-informasi', function () {
        // Fetch ID and Name, then filter to unique names to avoid duplicates in dropdown
        // Use values() to reset keys ensuring valid JSON array for frontend
        $masterPekerjaan = MasterPekerjaan::active()->select('id', 'nama_pekerjaan')->orderBy('nama_pekerjaan')->get()->unique('nama_pekerjaan')->values();
        $masterDomisili = App\Models\MasterDomisili::active()->select('id', 'nama_daerah')->orderBy('nama_daerah')->get()->unique('nama_daerah')->values();
        $bentukInformasis = BentukInformasi::all();

        return view('pages.layanan.permohonan-informasi', compact('masterPekerjaan', 'masterDomisili', 'bentukInformasis'));
    });
    // Unified status check route
    Route::get('/layanan/cek-status', [StatusCheckController::class, 'showForm'])->name('layanan.cek-status');

    // Redirects from old URLs to new unified page
    Route::get('/layanan/cek-status-permohonan', function () {
        return redirect()->route('layanan.cek-status', ['type' => 'permohonan']);
    })->name('layanan.cek-status-permohonan');

    Route::get('/layanan/pengajuan-keberatan/cek-status', function () {
        return redirect()->route('layanan.cek-status', ['type' => 'keberatan']);
    })->name('layanan.pengajuan-keberatan.check-status');

    Route::get('/layanan/pengajuan-keberatan', function () {
        $masterPekerjaan = MasterPekerjaan::active()->select('nama_pekerjaan')->distinct()->orderBy('nama_pekerjaan')->get();
        $alasanPengajuans = AlasanPengajuan::orderBy('alasan')->get();

        return view('pages.layanan.pengajuan-keberatan', compact('masterPekerjaan', 'alasanPengajuans'));
    })->name('layanan.pengajuan-keberatan');

    Route::get('/layanan/pengajuan-keberatan/detail/{no_pendaftaran}', [GuestPengajuanKeberatanController::class, 'showDetail'])
        ->name('layanan.detail-status-keberatan')
        ->where('no_pendaftaran', '.*');

    // Rute Permohonan Informasi
    Route::post('/layanan/permohonan-informasi', [App\Http\Controllers\PermohonanInformasiController::class, 'store'])->name('layanan.permohonan-informasi.store');

    Route::post('/layanan/pengajuan-keberatan', [GuestPengajuanKeberatanController::class, 'store'])
        ->middleware(['honeypot', 'throttle:public-form'])
        ->name('layanan.pengajuan-keberatan.store');

    Route::get('/layanan/sop', [GuestSopController::class, 'index'])->name('layanan.sop');
    Route::get('/layanan/sop/download/{id}', [GuestSopController::class, 'download'])->name('layanan.sop.download');


    // Survey Pages
    Route::get('/survey/isi-survey', [\App\Http\Controllers\SurveyController::class, 'create']);
    Route::get('/survey/hasil-survey', [\App\Http\Controllers\SurveyController::class, 'showResults']);
});

Route::post('/layanan/permohonan-informasi', [GuestPermohonanInformasiController::class, 'store'])
    ->middleware(['honeypot', 'throttle:public-form'])
    ->name('layanan.permohonan-informasi.store');

// Unified status check POST route
Route::post('/layanan/cek-status', [StatusCheckController::class, 'checkStatus'])
    ->middleware(['throttle:check-status'])
    ->name('layanan.cek-status.check');

Route::post('/survey/isi-survey', [\App\Http\Controllers\SurveyController::class, 'store'])
    ->middleware(['honeypot', 'throttle:public-form'])
    ->name('survey.store');


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Rute yang bisa diakses admin & odp
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pengaturan', PengaturanController::class);
    Route::resource('struktur-organisasi', StrukturOrganisasiController::class);

    // Profil Management Routes
    Route::resource('profil-ppid', ProfilPpidController::class)->only(['index', 'store']);
    Route::resource('integrated-services', IntegratedServiceController::class);
    Route::resource('sambutan', SambutanController::class)->only(['index', 'store']);
    Route::resource('visi-misi', VisiMisiController::class)->only(['index', 'store']);
    Route::resource('tupoksi', TupoksiController::class)->only(['index', 'store']);
    Route::resource('maklumat', MaklumatController::class)->only(['index', 'store']);
    Route::resource('profil-pemprov', ProfilPemprovController::class)->only(['index', 'store']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('notifications/delete-all', [NotificationController::class, 'deleteAll'])->name('notifications.delete-all');
    Route::delete('notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    // Rute yang dibatasi berdasarkan ID SKPD menggunakan Middleware
    Route::middleware(['check_skpd'])->group(function () {
        Route::resource('skpd', SkpdController::class);

        Route::resource('berita', BeritaController::class);
        Route::resource('berita', BeritaController::class);
        // Permohonan Informasi moved to Admin group
        Route::resource('pengajuan-keberatan', PengajuanKeberatanController::class);
        Route::post('pengajuan-keberatan/{id}/feedback', [PengajuanKeberatanController::class, 'storeFeedback'])->name('pengajuan-keberatan.storeFeedback');
        Route::get('pengajuan-keberatan/{id}/feedback', [PengajuanKeberatanController::class, 'loadFeedback'])->name('pengajuan-keberatan.loadFeedback');
        Route::get('pengajuan-keberatan/{id}/disposisi', [PengajuanKeberatanController::class, 'disposisiForm'])->name('pengajuan-keberatan.disposisi');
        Route::post('pengajuan-keberatan/{id}/disposisi', [PengajuanKeberatanController::class, 'disposisiStore'])->name('pengajuan-keberatan.disposisi.store');
        Route::post('pengajuan-keberatan/disposisi/{disposisiId}/respon', [PengajuanKeberatanController::class, 'responStore'])->name('pengajuan-keberatan.respon.store');

        Route::resource('dokumen-publik', DokumenPublikController::class);
        Route::post('dokumen-publik/bulk-delete', [DokumenPublikController::class, 'bulkDelete'])->name('dokumen-publik.bulk-delete');
        Route::post('dokumen-publik/bulk-update-status', [DokumenPublikController::class, 'bulkUpdateStatus'])->name('dokumen-publik.bulk-update-status');


        Route::resource('matriks-dip', MatriksDIPController::class);

        // Disposisi routes (must be before resource route)
        Route::get('permohonan-informasi/{id}/disposisi', [PermohonanInformasiController::class, 'disposisiForm'])->name('permohonan-informasi.disposisi');
        Route::post('permohonan-informasi/{id}/disposisi', [PermohonanInformasiController::class, 'disposisiStore']);

        // SKPD Response to Disposition
        Route::post('permohonan-informasi/disposisi/{disposisiId}/respon', [PermohonanInformasiController::class, 'responStore'])->name('permohonan-informasi.respon.store');

        Route::resource('permohonan-informasi', PermohonanInformasiController::class);
        Route::resource('ikphns', IkphnController::class);
    });

    // Rute khusus Super Admin (Tanpa check_skpd karena mengelola semua SKPD)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('data-sop', SopController::class);
        Route::resource('slide-banner', SlideBannerController::class);
        Route::resource('faq', FaqController::class);
        Route::resource('users', UserController::class);
        Route::get('/log-login', [LogLoginController::class, 'index'])->name('log-login.index');

        // Metadata Informasi
        Route::resource('kategori-informasi', KategoriInformasiController::class);

        // Footer Settings
        Route::get('/footer-settings', [FooterSettingController::class, 'index'])->name('footer-settings.index');
        Route::post('/footer-settings', [FooterSettingController::class, 'update'])->name('footer-settings.update');

        // Survey Questions
        Route::resource('survey-questions', SurveyQuestionController::class);
        // Survey Responses
        Route::resource('survey-responses', SurveyResponseController::class)->only(['index', 'show', 'destroy']);

        // Social Links CRUD
        Route::resource('social-links', SosmedController::class);

        // Create Alasan Pengajuan Resource
        Route::resource('alasan-pengajuan', AlasanPengajuanController::class)->except(['show']);

        // Unified Master Data Management
        Route::get('master-data', [MasterDataController::class, 'index'])->name('master-data.index');

        // CRUD Routes for Master Data components (used by forms)
        Route::post('master-data/kategori', [KategoriInformasiController::class, 'store'])->name('master-data.kategori.store');
        Route::put('master-data/kategori/{id}', [KategoriInformasiController::class, 'update'])->name('master-data.kategori.update');
        Route::delete('master-data/kategori/{id}', [KategoriInformasiController::class, 'destroy'])->name('master-data.kategori.destroy');

        Route::post('master-data/tahun', [MasterTahunController::class, 'store'])->name('master-data.tahun.store');
        Route::put('master-data/tahun/{id}', [MasterTahunController::class, 'update'])->name('master-data.tahun.update');
        Route::delete('master-data/tahun/{id}', [MasterTahunController::class, 'destroy'])->name('master-data.tahun.destroy');

        Route::post('master-data/domisili', [MasterDomisiliController::class, 'store'])->name('master-data.domisili.store');
        Route::put('master-data/domisili/{id}', [MasterDomisiliController::class, 'update'])->name('master-data.domisili.update');
        Route::delete('master-data/domisili/{id}', [MasterDomisiliController::class, 'destroy'])->name('master-data.domisili.destroy');

        Route::post('master-data/pekerjaan', [MasterPekerjaanController::class, 'store'])->name('master-data.pekerjaan.store');
        Route::put('master-data/pekerjaan/{id}', [MasterPekerjaanController::class, 'update'])->name('master-data.pekerjaan.update');
        Route::delete('master-data/pekerjaan/{id}', [MasterPekerjaanController::class, 'destroy'])->name('master-data.pekerjaan.destroy');

        Route::post('master-data/alasan-pengajuan', [AlasanPengajuanController::class, 'store'])->name('master-data.alasan-pengajuan.store');
        Route::put('master-data/alasan-pengajuan/{id}', [AlasanPengajuanController::class, 'update'])->name('master-data.alasan-pengajuan.update');
        Route::delete('master-data/alasan-pengajuan/{id}', [AlasanPengajuanController::class, 'destroy'])->name('master-data.alasan-pengajuan.destroy');

        Route::post('master-data/bentuk-informasi', [BentukInformasiController::class, 'store'])->name('master-data.bentuk-informasi.store');
        Route::put('master-data/bentuk-informasi/{id}', [BentukInformasiController::class, 'update'])->name('master-data.bentuk-informasi.update');
        Route::delete('master-data/bentuk-informasi/{id}', [BentukInformasiController::class, 'destroy'])->name('master-data.bentuk-informasi.destroy');

        // Keep existing individual routes for backward compatibility
        Route::resource('master-pekerjaan', MasterPekerjaanController::class);
        Route::resource('master-domisili', MasterDomisiliController::class);
        Route::resource('master-tahun', MasterTahunController::class);
    });    
});

require __DIR__ . '/auth.php';
