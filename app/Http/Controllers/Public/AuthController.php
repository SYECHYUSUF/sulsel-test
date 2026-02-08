<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $user = $request->user();

        // Hapus token lama jika Anda ingin membatasi satu sesi per user
        $user->tokens()->delete();

        // Buat token baru
        $token = $user->createToken('svelte-token')->plainTextToken;

        // Load relasi skpd agar nm_skpd tersedia di dalam objek user
        // Method 'skpd' merujuk pada relasi di model User
        $user->load(['skpd' => function($query) {
            $query->select('id_skpd', 'nm_skpd');
        }]);

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $user, // Mengirim objek user lengkap untuk pengecekan id_skpd
        ]);
    }
    
    public function logout(Request $request)
    {
        // Menghapus SEMUA token milik user ini
        $request->user()->tokens()->delete();

        return response()->json(['status' => 'success']);
    }
}
