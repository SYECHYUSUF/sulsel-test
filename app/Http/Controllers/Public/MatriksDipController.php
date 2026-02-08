<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\MatriksDip;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MatriksDipController extends Controller
{
    /**
     * Ambil daftar Matriks DIP aktif.
     */
    public function index(Request $request): JsonResponse
    {
        $search = $request->query('search');
        
        $matriksDip = MatriksDip::where('is_active', 1)
            ->when($search, function ($query, $search) {
                return $query->where('b', 'LIKE', "%{$search}%")
                    ->orWhere('c', 'LIKE', "%{$search}%")
                    ->orWhere('d', 'LIKE', "%{$search}%")
                    ->orWhere('e', 'LIKE', "%{$search}%")
                    ->orWhere('f', 'LIKE', "%{$search}%")
                    ->orWhere('g', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $matriksDip,
            'filters' => [
                'search' => $search
            ]
        ]);
    }

    /**
     * Ambil Matriks DIP berdasarkan tahun tertentu.
     */
    public function tahun(Request $request, $tahun): JsonResponse
    {
        $search = $request->query('search');
        
        $matriksDip = MatriksDip::where('g', 'LIKE', "%{$tahun}%")
            ->where('is_active', 1)
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('b', 'LIKE', "%{$search}%")
                        ->orWhere('c', 'LIKE', "%{$search}%")
                        ->orWhere('d', 'LIKE', "%{$search}%")
                        ->orWhere('e', 'LIKE', "%{$search}%")
                        ->orWhere('f', 'LIKE', "%{$search}%")
                        ->orWhere('g', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(10);

        return response()->json([
            'success' => true,
            'tahun' => $tahun,
            'data' => $matriksDip,
            'filters' => [
                'search' => $search
            ]
        ]);
    }
}