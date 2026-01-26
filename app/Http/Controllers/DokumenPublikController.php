<?php

namespace App\Http\Controllers;

use App\Models\DokumenPublik;
use Illuminate\Http\Request;

class DokumenPublikController extends Controller
{
    public function suggestions(Request $request)
    {
        $query = $request->get('query');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        // Join untuk mendapatkan nama kategori
        $results = DokumenPublik::join('tbl_kat_informasi', 'tbl_informasi.id_kat_info', '=', 'tbl_kat_informasi.id_kat_info')
            ->where('tbl_informasi.verify', 'y')
            ->where(function($q) use ($query) {
                $q->where('tbl_informasi.judul', 'LIKE', "%{$query}%")
                ->orWhere('tbl_informasi.ket', 'LIKE', "%{$query}%");
            })
            ->limit(5)
            ->get([
                'tbl_informasi.id_informasi', 
                'tbl_informasi.judul', 
                'tbl_informasi.ket', 
                'tbl_kat_informasi.nm_kat_info' 
            ]);

        return response()->json($results);
    }
}
