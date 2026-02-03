<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermohonanInformasiRequest;
use App\Http\Requests\CheckStatusRequest;
use App\Models\PermohonanInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PermohonanInformasiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermohonanInformasiRequest $request)
    {
        // Validation and sanitization already handled by Form Request
        $validated = $request->validated();

        try {
            $data = collect($validated)->except(['foto_ktp', 'website', '_form_timestamp'])->toArray();
            
            // Handle File Upload with secure filename
            if ($request->hasFile('foto_ktp')) {
                $file = $request->file('foto_ktp');
                
                // Generate secure random filename to prevent path traversal
                $extension = $file->getClientOriginalExtension();
                $filename = Str::uuid() . '.' . $extension;
                
                $path = $file->storeAs('permohonan/ktp', $filename, 'public');
                $data['foto_ktp'] = $path;
            }

            // Set default values
            $data['status'] = PermohonanInformasi::STATUS_PENDING;
            $data['is_cek'] = '0';
            
            // Create the permohonan
            $permohonan = PermohonanInformasi::create($data);

            // Send notification to all admin users
            $adminUsers = \App\Models\User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->get();

            foreach ($adminUsers as $admin) {
                \App\Models\Notification::send([
                    'to_user_id' => $admin->id,
                    'type' => 'info',
                    'title' => 'Permohonan Informasi Baru',
                    'message' => 'Permohonan informasi baru dari ' . $permohonan->nama . ' (' . $permohonan->email . ')',
                    'url' => route('admin.permohonan-informasi.show', $permohonan->id_permohonan),
                    'notifiable_type' => 'App\\Models\\PermohonanInformasi',
                    'notifiable_id' => $permohonan->id_permohonan,
                ]);
            }

            return redirect()->back()->with('success', 'Permohonan informasi berhasil dikirim. Nomor pendaftaran: ' . $permohonan->no_pendaftaran);

        } catch (\Exception $e) {
            Log::error('Permohonan Informasi Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim permohonan. Silakan coba lagi.')->withInput();
        }
    }

    /**
     * Show check progress form.
     */
    public function checkProgressForm()
    {
        return view('pages.layanan.cek-status-permohonan');
    }

  
    /**
     * Check progress by email.
     */
    public function checkProgress(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $permohonan = PermohonanInformasi::with(['skpd', 'disposisi.skpd', 'disposisi.respon'])
            ->where('email', $request->email)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($permohonan->isEmpty()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada permohonan ditemukan dengan email tersebut.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Tidak ada permohonan ditemukan dengan email tersebut.');
        }

        // Perbaikan: Transform data untuk menyertakan label status dan format tanggal
        if ($request->expectsJson() || $request->ajax()) {
            $permohonan->transform(function ($item) {
                // Mapping status secara manual agar aman jika accessor di model tidak diset ke $appends
                $labels = [
                    0 => 'Menunggu Verifikasi',
                    1 => 'Diproses',
                    2 => 'Selesai',
                    3 => 'Ditolak',
                    4 => 'Dibatalkan',
                    5 => 'Disposisi'
                ];
                
                $item->status_label = $labels[$item->status] ?? 'Status Tidak Diketahui';
                // Format tanggal agar konsisten di frontend
                $item->formatted_date = $item->created_at->translatedFormat('d F Y H:i') . ' WITA';
                
                return $item;
            });

            return response()->json([
                'success' => true,
                'data' => $permohonan
            ]);
        }

        return view('pages.layanan.cek-status-permohonan', compact('permohonan'));
    }
}
