<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController as PublicBeritaController;
use App\Http\Controllers\DokumenPublikController as GuestDokumenPublikController;

// Language Switcher
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return back();
});

Route::get('/api/dokumen-publik/search-suggestions', [GuestDokumenPublikController::class, 'suggestions']);

Route::middleware(['track.visitors'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/contact', function () {
        return view('pages.contact');
    });

    // Profil Pages
    Route::get('/profil-ppid', function () {
        return view('pages.profil.profil-ppid');
    });
    Route::get('/sambutan', function () {
        return view('pages.profil.sambutan');
    });
    Route::get('/struktur-organisasi', function () {
        return view('pages.profil.struktur-organisasi');
    });
    Route::get('/visi-misi', function () {
        return view('pages.profil.visi-misi');
    });
    Route::get('/tupoksi', function () {
        return view('pages.profil.tupoksi');
    });
    Route::get('/maklumat-pelayanan', function () {
        return view('pages.profil.maklumat');
    });
    Route::get('/profil-pemprov', function () {
        return view('pages.profil.pemerintah');
    });
    Route::get('/ppid-pelaksana', function () {
        return view('pages.profil.ppid-pelaksana');
    });

    // Berita Pages
    Route::get('/berita', [PublicBeritaController::class, 'index']);
    Route::get('/berita/{slug}', [PublicBeritaController::class, 'show'])->name('berita.show');

    // Informasi Publik Pages
    Route::get('/informasi-publik', function () {
        return view('pages.informasi-publik.index');
    });
    Route::get('/informasi-publik/2023', function () {
        return view('pages.informasi-publik.tahun-2023');
    });
    Route::get('/informasi-publik/2024', function () {
        return view('pages.informasi-publik.tahun-2024');
    });
    Route::get('/informasi-publik/2025', function () {
        return view('pages.informasi-publik.tahun-2025');
    });
    Route::get('/informasi-publik/serta-merta', function () {
        return view('pages.informasi-publik.serta-merta');
    });
    Route::get('/informasi-publik/setiap-saat', function () {
        return view('pages.informasi-publik.setiap-saat');
    });
    Route::get('/informasi-publik/dikecualikan', function () {
        return view('pages.informasi-publik.dikecualikan');
    });
    Route::get('/informasi-publik/berkala', function () {
        return view('pages.informasi-publik.berkala');
    });
    Route::get('/informasi-publik/pengadaan', function () {
        return view('pages.informasi-publik.pengadaan');
    });

    // Layanan Pages
    Route::get('/layanan/permohonan-informasi', function () {
        return view('pages.layanan.permohonan-informasi');
    });
    Route::get('/layanan/pengajuan-keberatan', function () {
        return view('pages.layanan.pengajuan-keberatan');
    });
    Route::get('/layanan/sop', function () {
        return view('pages.layanan.sop');
    });

    // Survey Pages
    Route::get('/survey/isi-survey', function () {
        return view('pages.survey.isi-survey');
    });
    Route::get('/survey/hasil-survey', function () {
        return view('pages.survey.hasil-survey');
    });
});

// Admin Routes
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DokumenPublikController;
use App\Http\Controllers\Admin\PengajuanKeberatanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PermohonanInformasiController;
use App\Http\Controllers\Admin\SkpdController;
use App\Http\Controllers\Admin\SlideBannerController;
use App\Http\Controllers\SopController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\KategoriInformasiController;
use App\Http\Controllers\Admin\LogLoginController;
use App\Http\Controllers\Admin\MatriksDIPController;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Rute yang bisa diakses admin & odp
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pengaturan', PengaturanController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute yang dibatasi berdasarkan ID SKPD menggunakan Middleware
    Route::middleware(['check_skpd'])->group(function () {
        Route::resource('skpd', SkpdController::class);

        Route::resource('berita', BeritaController::class);
        Route::resource('permohonan-informasi', PermohonanInformasiController::class);
        Route::resource('pengajuan-keberatan', PengajuanKeberatanController::class);

        // Master Data
        // Route::post('informasi-publik/bulk-delete', [InformasiController::class, 'bulkDelete'])->name('informasi-publik.bulk-delete');
        // Route::post('informasi-publik/bulk-update-status', [InformasiController::class, 'bulkUpdateStatus'])->name('informasi-publik.bulk-update-status');
        // Route::resource('informasi-publik', InformasiPublikController::class);
        // Route::resource('dokumen', InformasiPublikController::class);

        Route::resource('dokumen-publik', DokumenPublikController::class);
        Route::post('dokumen-publik/bulk-delete', [DokumenPublikController::class, 'bulkDelete'])->name('dokumen-publik.bulk-delete');
        Route::post('dokumen-publik/bulk-update-status', [DokumenPublikController::class, 'bulkUpdateStatus'])->name('dokumen-publik.bulk-update-status');

        Route::resource('matriks-dip', MatriksDIPController::class);
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
    });
});

require __DIR__ . '/auth.php';
