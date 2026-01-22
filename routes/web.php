<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
// Language Switcher
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return back();
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
Route::get('/berita', function () {
    return view('pages.berita.index');
});
Route::get('/berita/detail', function () {
    return view('pages.berita.show');
});

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

// Admin Routes
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\PengajuanKeberatanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PermohonanInformasiController;
use App\Http\Controllers\Admin\SkpdController;
use App\Http\Controllers\Admin\SlideBannerController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('berita', BeritaController::class);
    Route::resource('data-skpd', SkpdController::class);
    Route::resource('permohonan-informasi', PermohonanInformasiController::class);
    Route::resource('slide-banner', SlideBannerController::class);
    Route::resource('pengajuan-keberatan', PengajuanKeberatanController::class);
    Route::resource('data-sop', SkpdController::class);
    Route::resource('pengaturan', PengaturanController::class);
});
