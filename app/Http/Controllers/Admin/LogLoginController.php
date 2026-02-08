<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogLogin;
use Illuminate\Http\JsonResponse;

class LogLoginController extends Controller
{
    /**
     * Menampilkan daftar log riwayat login pengguna.
     */
    public function index(): JsonResponse
    {
        $logs = LogLogin::with('user')
                ->orderBy('id', 'desc') 
                ->paginate(20);
        
        return response()->json([
            'success' => true,
            'message' => 'Daftar log login berhasil diambil',
            'data' => $logs
        ], 200);
    }
}