<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\VisitorLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function track(Request $request)
    {
        $ip = $request->ip();
        $today = Carbon::today();
        $dateString = $today->toDateString();

        // 1. Cek apakah IP ini sudah berkunjung hari ini di tabel LOG
        $alreadyLogged = VisitorLog::where('ip_address', $ip)
            ->where('visit_date', $dateString)
            ->exists();

        if (!$alreadyLogged) {
            // 2. Catat IP baru ke LOG agar besok tidak dihitung lagi
            VisitorLog::create([
                'ip_address' => $ip,
                'visit_date' => $dateString
            ]);

            // 3. Update atau Buat data di tabel 'visitors'
            // Kita cari data berdasarkan tanggal di created_at
            $visitor = Visitor::whereDate('created_at', $today)->first();

            if ($visitor) {
                $visitor->increment('count');
            } else {
                Visitor::create([
                    'count' => 1,
                    'created_at' => $today,
                    'updated_at' => $today
                ]);
            }

            return response()->json(['status' => 'counted']);
        }

        return response()->json(['status' => 'already_counted']);
    }
}