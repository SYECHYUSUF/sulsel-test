<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//  Serve files from the storage/app/public directory
//  Example URL:
//  http://localhost:8000/uploads/logo-skpd/VuwzepLEmFqOdrmDB4EMGmkx4i9S6NAoXo1cMVIV.png
Route::get('/uploads/{path}', function ($path) {
    return response()->file(
        storage_path('app/public/' . $path)
    );
})->where('path', '.*');

