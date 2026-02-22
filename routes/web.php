<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['status' => 'online', 'message' => 'PPID API Service']);
});

//  Serve files from the storage/app/public directory
//  Example URL:
//  http://localhost:8000/uploads/logo-skpd/VuwzepLEmFqOdrmDB4EMGmkx4i9S6NAoXo1cMVIV.png
// Route::get('/uploads/{path}', function ($path) {
//     return response()->file(
//         storage_path('app/public/' . $path)
//     );
// })->where('path', '.*');

// Redirect dari URL lokal ke URL publik Supabase
Route::get('/uploads/{path}', function ($path) {
    // Ambil base URL Supabase dari .env atau config
    // Contoh: https://[PROJECT_ID].supabase.co/storage/v1/object/public/
    $supabaseUrl = str_replace('.supabase.co', '', parse_url(env('DB_URL'), PHP_URL_HOST));
    $projectId = explode('.', $supabaseUrl)[0];
    
    $bucket = env('SUPABASE_STORAGE_BUCKET');
    $publicUrl = "https://{$projectId}.supabase.co/storage/v1/object/public/{$bucket}/{$path}";

    // Lakukan redirect 302 (Temporary Redirect)
    return Redirect::to($publicUrl);
})->where('path', '.*');
