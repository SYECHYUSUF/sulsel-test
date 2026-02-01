<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController as GuestBeritaController;
use App\Http\Controllers\DokumenPublikController as GuestDokumenPublikController;
use App\Http\Controllers\MatriksDipController as GuestMatriksDipController;
use App\Http\Controllers\SopController as GuestSopController;
use App\Http\Controllers\PengajuanKeberatanController as GuestPengajuanKeberatanController;
use App\Http\Controllers\PermohonanInformasiController as GuestPermohonanInformasiController;

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
use App\Http\Controllers\Admin\KategoriInformasiController;
use App\Http\Controllers\Admin\LogLoginController;
use App\Http\Controllers\Admin\MatriksDIPController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SurveyQuestionController;
use App\Http\Controllers\Admin\SurveyResponseController;
use App\Http\Controllers\Admin\SosmedController;

use App\Models\Setting;
use App\Models\Skpd;

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
        $profil = \App\Models\Profil::getByTipe('profil-ppid');
        return view('pages.profil.profil-ppid', compact('profil'));
    });
    Route::get('/sambutan', function () {
        $profil = \App\Models\Profil::getByTipe('sambutan');
        $recentNews = \App\Models\Berita::where('verify', 'y')
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
        $profil = \App\Models\Profil::getByTipe('visi-misi');
        $recentNews = \App\Models\Berita::where('verify', 'y')
            ->orderBy('tgl_upload', 'desc')
            ->take(4)
            ->get();
        return view('pages.profil.visi-misi', compact('recentNews', 'profil'));
    });
    Route::get('/tupoksi', function () {
        $profil = \App\Models\Profil::getByTipe('tupoksi');
        return view('pages.profil.tupoksi', compact('profil'));
    });
    Route::get('/maklumat-pelayanan', function () {
        $profil = \App\Models\Profil::getByTipe('maklumat');
        return view('pages.profil.maklumat', compact('profil'));
    });
    Route::get('/profil-pemprov', function () {
        $profil = \App\Models\Profil::getByTipe('pemerintah');
        return view('pages.profil.pemerintah', compact('profil'));
    });

    Route::get('/ppid-pelaksana', function (Illuminate\Http\Request $request) {
        $search = $request->input('search');
        
        $query = Skpd::orderBy('nm_skpd', 'asc');
        
        // Apply search filter if search term exists
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nm_skpd', 'like', '%' . $search . '%')
                  ->orWhere('alamat', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('website', 'like', '%' . $search . '%');
            });
        }
        
        $ppidData = $query->paginate(12)->appends(['search' => $search]);
        
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
    Route::get('/informasi-publik/2023', [GuestMatriksDipController::class, 'tahun2023']);
    Route::get('/informasi-publik/2024', [GuestMatriksDipController::class, 'tahun2024']);
    Route::get('/informasi-publik/2025', [GuestMatriksDipController::class, 'tahun2025']);
    Route::get('/informasi-publik/serta-merta', [GuestDokumenPublikController::class, 'sertaMerta']);
    Route::get('/informasi-publik/setiap-saat', [GuestDokumenPublikController::class, 'setiapSaat']);
    Route::get('/informasi-publik/dikecualikan', [GuestDokumenPublikController::class, 'dikecualikan']);
    Route::get('/informasi-publik/berkala', [GuestDokumenPublikController::class, 'berkala']);
    Route::get('/informasi-publik/pengadaan', [GuestMatriksDipController::class, 'pengadaan']);
    Route::get('/informasi-publik/detail/{id}', [GuestDokumenPublikController::class, 'show'])->name('informasi-publik.show');

    // Layanan Pages
    Route::get('/layanan/permohonan-informasi', function () {
        $masterPekerjaan = \App\Models\MasterPekerjaan::active()->orderBy('nama_pekerjaan')->get();
        $masterDomisili = \App\Models\MasterDomisili::active()->orderBy('nama_daerah')->get();
        return view('pages.layanan.permohonan-informasi', compact('masterPekerjaan', 'masterDomisili'));
    });
    Route::get('/layanan/cek-status-permohonan', [GuestPermohonanInformasiController::class, 'checkProgressForm'])->name('layanan.cek-status-permohonan');
    Route::get('/layanan/pengajuan-keberatan', function () {
        return view('pages.layanan.pengajuan-keberatan');
    });
    
    // Rute Permohonan Informasi
    Route::post('/layanan/permohonan-informasi', [App\Http\Controllers\PermohonanInformasiController::class, 'store'])->name('layanan.permohonan-informasi.store');
    
    Route::post('/layanan/pengajuan-keberatan', [GuestPengajuanKeberatanController::class, 'store'])->name('layanan.pengajuan-keberatan.store');

    // Check Status Routes
    Route::get('/layanan/pengajuan-keberatan/cek-status', [GuestPengajuanKeberatanController::class, 'formCheckStatus'])->name('layanan.pengajuan-keberatan.check-status');

    Route::get('/layanan/sop', [GuestSopController::class, 'index'])->name('layanan.sop');
    Route::get('/layanan/sop/download/{id}', [GuestSopController::class, 'download'])->name('layanan.sop.download');
    

    // Survey Pages
    Route::get('/survey/isi-survey', [\App\Http\Controllers\SurveyController::class, 'create']);
    Route::get('/survey/hasil-survey', [\App\Http\Controllers\SurveyController::class, 'showResults']);
});

Route::post('/layanan/permohonan-informasi', [GuestPermohonanInformasiController::class, 'store'])->name('layanan.permohonan-informasi.store');

Route::post('/layanan/cek-status-permohonan', [GuestPermohonanInformasiController::class, 'checkProgress']);

Route::post('/layanan/pengajuan-keberatan/cek-status', [GuestPengajuanKeberatanController::class, 'checkStatus']);

Route::post('/survey/isi-survey', [\App\Http\Controllers\SurveyController::class, 'store'])->name('survey.store');


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Rute yang bisa diakses admin & odp
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pengaturan', PengaturanController::class);
    Route::resource('struktur-organisasi', \App\Http\Controllers\Admin\StrukturOrganisasiController::class);

    // Profil Management Routes
    Route::resource('profil-ppid', \App\Http\Controllers\Admin\ProfilPpidController::class)->only(['index', 'store']);
    Route::resource('sambutan', \App\Http\Controllers\Admin\SambutanController::class)->only(['index', 'store']);
    Route::resource('visi-misi', \App\Http\Controllers\Admin\VisiMisiController::class)->only(['index', 'store']);
    Route::resource('tupoksi', \App\Http\Controllers\Admin\TupoksiController::class)->only(['index', 'store']);
    Route::resource('maklumat', \App\Http\Controllers\Admin\MaklumatController::class)->only(['index', 'store']);
    Route::resource('profil-pemprov', \App\Http\Controllers\Admin\ProfilPemprovController::class)->only(['index', 'store']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('notifications', [\App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{id}/read', [\App\Http\Controllers\Admin\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('notifications/mark-all-read', [\App\Http\Controllers\Admin\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('notifications/delete-all', [\App\Http\Controllers\Admin\NotificationController::class, 'deleteAll'])->name('notifications.delete-all');
    Route::delete('notifications/{id}', [\App\Http\Controllers\Admin\NotificationController::class, 'destroy'])->name('notifications.destroy');


    // Rute yang dibatasi berdasarkan ID SKPD menggunakan Middleware
    Route::middleware(['check_skpd'])->group(function () {
        Route::resource('skpd', SkpdController::class);

        Route::resource('berita', BeritaController::class);
        Route::resource('berita', BeritaController::class);
        // Permohonan Informasi moved to Admin group
        Route::resource('pengajuan-keberatan', PengajuanKeberatanController::class);
        Route::post('pengajuan-keberatan/{id}/feedback', [PengajuanKeberatanController::class, 'storeFeedback'])->name('pengajuan-keberatan.storeFeedback');
        Route::get('pengajuan-keberatan/{id}/feedback', [PengajuanKeberatanController::class, 'loadFeedback'])->name('pengajuan-keberatan.loadFeedback');

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

        // Survey Questions
        Route::resource('survey-questions', SurveyQuestionController::class);
        // Survey Responses
        Route::resource('survey-responses', SurveyResponseController::class)->only(['index', 'show', 'destroy']);

        // Social Links CRUD
        Route::resource('social-links', SosmedController::class);
        
        // Master Data Management
        Route::resource('master-pekerjaan', \App\Http\Controllers\Admin\MasterPekerjaanController::class);
        Route::resource('master-domisili', \App\Http\Controllers\Admin\MasterDomisiliController::class);
    });
});

require __DIR__ . '/auth.php';
