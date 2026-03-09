<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogLogin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogLoginController extends Controller
{
    /**
     * Menampilkan daftar log riwayat login pengguna dengan filter.
     */
    public function index(Request $request): JsonResponse
    {
        $query = LogLogin::with('user:id,name,username');

        // Filter Pencarian Nama atau Username (hanya jika 'search' diisi)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function($userQuery) use ($search) {
                $userQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%");
            });
        }

        // Filter IP secara spesifik (hanya jika 'ip' diisi)
        if ($request->filled('ip')) {
            $ip = $request->input('ip');
            $query->where('ip', 'like', "%{$ip}%");
        }

        // Filter Rentang Tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('createdAt', '>=', $request->input('start_date'));
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('createdAt', '<=', $request->input('end_date'));
        }

        // Fitur Pengurutan
        $sort = $request->input('sort', 'newest');
        $query->orderBy('createdAt', ($sort === 'oldest' ? 'asc' : 'desc'));

        // Eksekusi Paginasi
        $logs = $query->paginate($request->input('per_page', 20));

        return response()->json([
            'success' => true,
            'message' => 'Daftar log login berhasil diambil',
            'data' => $logs
        ], 200);
    }
}