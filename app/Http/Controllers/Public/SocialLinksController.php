<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Sosmed;

class SocialLinksController extends Controller
{
    /**
     * Get active social links for public display
     */
    public function index()
    {
        try {
            $socialLinks = Sosmed::where('is_active', '1')
                ->orderBy('urutan')
                ->get(['id_sosmed', 'nm_sosmed', 'link_sosmed', 'icon_sosmed', 'urutan']);
            
            return response()->json([
                'success' => true,
                'data' => $socialLinks
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data social links',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
