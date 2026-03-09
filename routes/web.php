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
    // Gunakan Project ID yang benar dari URL valid kamu
    $projectId = 'jlosrcqjysykztuhegqs';
    $bucket = env('SUPABASE_STORAGE_BUCKET', 'ppid-sulselprov-bucket');

    // Susun URL sesuai format yang valid
    $publicUrl = "https://{$projectId}.supabase.co/storage/v1/object/public/{$bucket}/{$path}";

    // Gunakan away() untuk memastikan redirect ke domain eksternal secara penuh
    return Redirect::away($publicUrl);
})->where('path', '.*');
