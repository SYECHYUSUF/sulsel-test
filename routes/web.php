<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController as GuestBeritaController;
use App\Http\Controllers\DokumenPublikController as GuestDokumenPublikController;
use App\Http\Controllers\MatriksDipController as GuestMatriksDipController;
use App\Http\Controllers\SopController as GuestSopController;
use App\Http\Controllers\PengajuanKeberatanController as GuestPengajuanKeberatanController;

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
        $pdfPath = Setting::where('key', 'struktur_organisasi_path')->value('value');
        return view('pages.profil.struktur-organisasi', compact('pdfPath'));
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
        $ppidData = Skpd::orderBy('nm_skpd', 'asc')->paginate(12);
        return view('pages.profil.ppid-pelaksana', compact('ppidData'));
    });

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
        return view('pages.layanan.permohonan-informasi');
    });
    Route::get('/layanan/pengajuan-keberatan', function () {
        return view('pages.layanan.pengajuan-keberatan');
    });
    Route::post('/layanan/pengajuan-keberatan', [GuestPengajuanKeberatanController::class, 'store'])->name('layanan.pengajuan-keberatan.store');
    Route::get('/layanan/sop', [GuestSopController::class, 'index'])->name('layanan.sop');
    Route::get('/layanan/sop/download/{id}', [GuestSopController::class, 'download'])->name('layanan.sop.download');

    // Survey Pages
    Route::get('/survey/isi-survey', function () {
        return view('pages.survey.isi-survey');
    });
    Route::get('/survey/hasil-survey', function () {
        return view('pages.survey.hasil-survey');
    });
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Rute yang bisa diakses admin & odp
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pengaturan', PengaturanController::class);
    Route::resource('struktur-organisasi', \App\Http\Controllers\Admin\StrukturOrganisasiController::class); // Added route
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute yang dibatasi berdasarkan ID SKPD menggunakan Middleware
    Route::middleware(['check_skpd'])->group(function () {
        Route::resource('skpd', SkpdController::class);

        Route::resource('berita', BeritaController::class);
        Route::resource('permohonan-informasi', PermohonanInformasiController::class);
        Route::resource('pengajuan-keberatan', PengajuanKeberatanController::class);

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
