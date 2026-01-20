<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Profil Pages
Route::get('/profil-ppid', function () { return view('pages.profil.profil-ppid'); });
Route::get('/sambutan', function () { return view('pages.profil.sambutan'); });
Route::get('/struktur-organisasi', function () { return view('pages.profil.struktur-organisasi'); });
Route::get('/visi-misi', function () { return view('pages.profil.visi-misi'); });
Route::get('/tupoksi', function () { return view('pages.profil.tupoksi'); });
Route::get('/maklumat-pelayanan', function () { return view('pages.profil.maklumat'); });
Route::get('/profil-pemprov', function () { return view('pages.profil.pemerintah'); });
