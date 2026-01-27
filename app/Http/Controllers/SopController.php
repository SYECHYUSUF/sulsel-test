<?php

namespace App\Http\Controllers;

use App\Models\Sop;
use Illuminate\Http\Request;

class SopController extends Controller
{
    /**
     * Menampilkan daftar SOP.
     */

    public function index(Request $request)
    {
        $query = Sop::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $sopData = $query->latest()->paginate(10);

        return view('pages.layanan.sop', compact('sopData'));
    }

    public function download($id)
    {
        $sop = Sop::findOrFail($id);

        // Increment download count
        $sop->increment('jumlah_download');

        $filePath = 'sop/' . $sop->file;

        if (!\Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found');
        }

        return \Storage::disk('public')->download($filePath, $sop->judul . '.' . pathinfo($sop->file, PATHINFO_EXTENSION));
    }
}
