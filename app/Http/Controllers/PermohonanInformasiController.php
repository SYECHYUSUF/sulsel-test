<?php

namespace App\Http\Controllers;

use App\Models\PermohonanInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermohonanInformasiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16|regex:/^[0-9]{16}$/',
            'no_kk' => 'nullable|string|max:16',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'pekerjaan_id' => 'required|exists:master_pekerjaan,id',
            'domisili_id' => 'required|exists:master_domisili,id',
            'foto_ktp' => 'required|file|image|mimes:jpeg,jpg,png|max:5120', // 5MB
            
            // Info details
            'nmr_pengesahan' => 'nullable|string|max:255',
            'tujuan' => 'required|string',
            'rincian' => 'required|string',
        ]);

        try {
            $data = $request->except(['foto_ktp', '_token']);
            
            // Handle File Upload
            if ($request->hasFile('foto_ktp')) {
                $file = $request->file('foto_ktp');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('permohonan/ktp', $filename, 'public');
                $data['foto_ktp'] = $path;
            }

            // Set default values
            $data['status'] = PermohonanInformasi::STATUS_PENDING;
            $data['is_cek'] = '0';
            
            // Handle No KK if it exists in DB, migration check: It is NOT in migration 'create_information_service_tables.php'.
            // "nomor_kk" input exists in form.
            // If the column doesn't exist, we should probably ignore it or store it in 'keterangan' or similar if needed. 
            // For now, I'll ignore it to avoid SQL error, or map it if I missed a migration.
            // Re-reading migration: no 'no_kk'.
            
            // Map form fields to DB columns if names differ, but they seem to match mostly or I'll match them in blade.
            
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
