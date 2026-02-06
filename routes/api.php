<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rute yang WAJIB login (Protected)
Route::middleware('auth:sanctum')->group(function () {
    // Endpoint untuk Logout
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Endpoint untuk ambil data user (digunakan oleh hooks.server.ts)
    Route::get('/user', function (Request $request) {
        // Load relasi skpd agar nm_skpd tampil saat pengecekan di hooks
        return $request->user()->load('skpd:id_skpd,nm_skpd');
    });
    
});

Route::post('/auth/login', [AuthController::class, 'login']);
