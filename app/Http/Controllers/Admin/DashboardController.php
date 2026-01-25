<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Informasi;
use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use App\Models\Skpd;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('opd')) {
            return $this->opdDashboard($user);
        }

        return $this->adminDashboard();
    }

    /**
     * Admin Dashboard with full statistics
     */
    private function adminDashboard()
    {
        $stats = $this->getStatistics();
        $monthlyTrends = $this->getMonthlyTrends();
        $recentActivities = $this->getRecentActivities();
        $permohonanByStatus = $this->getPermohonanByStatus();

        return view('admin.dashboard.index', compact(
            'stats',
            'monthlyTrends',
            'recentActivities',
            'permohonanByStatus'
        ));
    }

    /**
     * OPD Dashboard with SKPD-filtered statistics
     */
    private function opdDashboard($user)
    {
        $idSkpd = $user->id_skpd;

        $stats = $this->getStatistics($idSkpd);
        $monthlyTrends = $this->getMonthlyTrends($idSkpd);
        $recentActivities = $this->getRecentActivities($idSkpd);
        $permohonanByStatus = $this->getPermohonanByStatus($idSkpd);

        return view('admin.dashboard.opd', compact(
            'stats',
            'monthlyTrends',
            'recentActivities',
            'permohonanByStatus'
        ));
    }

    /**
     * Get dashboard statistics
     */
    private function getStatistics($idSkpd = null)
    {
        // Base queries
        $permohonanQuery = PermohonanInformasi::query();
        $keberatanQuery = PengajuanKeberatan::query();
        $beritaQuery = Berita::query();
        $informasiQuery = Informasi::query();

        // Filter by SKPD if OPD role
        if ($idSkpd) {
            $permohonanQuery->where('id_skpd', $idSkpd);
            $keberatanQuery->where('id_skpd', $idSkpd);
            $beritaQuery->where('id_skpd', $idSkpd);
            $informasiQuery->where('id_skpd', $idSkpd);
        }

        // Current month counts for trend calculation
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $previousMonth = now()->subMonth()->month;
        $previousYear = now()->subMonth()->year;

        // Get current and previous month counts
        $currentPermohonan = (clone $permohonanQuery)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $previousPermohonan = (clone $permohonanQuery)
            ->whereYear('created_at', $previousYear)
            ->whereMonth('created_at', $previousMonth)
            ->count();

        // Calculate percentage change
        $permohonanTrend = $this->calculatePercentageChange($previousPermohonan, $currentPermohonan);

        return [
            'total_permohonan' => $permohonanQuery->count(),
            'total_keberatan' => $keberatanQuery->count(),
            'total_berita' => $beritaQuery->whereDate('created_at', '>=', now()->subDays(30))->count(),
            'total_skpd' => $idSkpd ? 1 : Skpd::count(),
            'total_dokumen' => $informasiQuery->count(),
            'total_visitor' => Visitor::sum('count') ?? 0,
            'permohonan_trend' => $permohonanTrend,
        ];
    }

    /**
     * Get monthly trends for last 12 months
     */
    private function getMonthlyTrends($idSkpd = null)
    {
        $months = [];
        $permohonanData = [];
        $keberatanData = [];

        // Get last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->format('M');
            $months[] = $monthName;

            // Permohonan count
            $permohonanQuery = PermohonanInformasi::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month);

            if ($idSkpd) {
                $permohonanQuery->where('id_skpd', $idSkpd);
            }

            $permohonanData[$monthName] = $permohonanQuery->count();

            // Keberatan count
            $keberatanQuery = PengajuanKeberatan::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month);

            if ($idSkpd) {
                $keberatanQuery->where('id_skpd', $idSkpd);
            }

            $keberatanData[$monthName] = $keberatanQuery->count();
        }

        // Find max value for percentage calculation
        $maxPermohonan = max($permohonanData) ?: 1;
        $maxKeberatan = max($keberatanData) ?: 1;

        return [
            'months' => $months,
            'permohonan' => $permohonanData,
            'keberatan' => $keberatanData,
            'permohonan_percentages' => array_map(fn($val) => round(($val / $maxPermohonan) * 100), $permohonanData),
            'keberatan_percentages' => array_map(fn($val) => round(($val / $maxKeberatan) * 100), $keberatanData),
        ];
    }

    /**
     * Get recent activities
     */
    private function getRecentActivities($idSkpd = null)
    {
        // Recent permohonan
        $recentPermohonanQuery = PermohonanInformasi::with('skpd')
            ->orderBy('created_at', 'desc')
            ->limit(10);

        if ($idSkpd) {
            $recentPermohonanQuery->where('id_skpd', $idSkpd);
        }

        // Recent informasi
        $recentInformasiQuery = Informasi::with('kategori')
            ->orderBy('tgl_upload', 'desc')
            ->limit(10);

        if ($idSkpd) {
            $recentInformasiQuery->where('id_skpd', $idSkpd);
        }

        return [
            'permohonan' => $recentPermohonanQuery->get(),
            'informasi' => $recentInformasiQuery->get(),
        ];
    }

    /**
     * Get permohonan grouped by status
     */
    private function getPermohonanByStatus($idSkpd = null)
    {
        $query = PermohonanInformasi::select('status', DB::raw('count(*) as total'))
            ->groupBy('status');

        if ($idSkpd) {
            $query->where('id_skpd', $idSkpd);
        }

        $results = $query->get()->keyBy('status');

        return [
            'pending' => $results->get(PermohonanInformasi::STATUS_PENDING)->total ?? 0,
            'proses' => $results->get(PermohonanInformasi::STATUS_PROSES)->total ?? 0,
            'selesai' => $results->get(PermohonanInformasi::STATUS_SELESAI)->total ?? 0,
            'tolak' => $results->get(PermohonanInformasi::STATUS_TOLAK)->total ?? 0,
        ];
    }

    /**
     * Calculate percentage change between two values
     */
    private function calculatePercentageChange($old, $new)
    {
        if ($old == 0) {
            return $new > 0 ? 100 : 0;
        }

        return round((($new - $old) / $old) * 100);
    }
}
