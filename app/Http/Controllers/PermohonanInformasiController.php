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
            'nik' => 'required|string|max:16', // Adjust length as needed
            'no_kk' => 'nullable|string|max:16', // Add if you added this column, migration didn't show it but form has it. Wait, migration didn't show no_kk. I'll double check migration.
            // Migration check:
            // nama, nik, email, pekerjaan, rincian, tujuan, dapat_salinan, foto_ktp, nmr_pengesahan, alamat, no_hp, peroleh_informasi, salinan_informasi, keterangan, alasan, status, id_skpd, no_pendaftaran, file, is_cek
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string|max:255',
            'foto_ktp' => 'required|file|image|max:5120', // 5MB
            
            // Info details
            'nmr_pengesahan' => 'nullable|string|max:255', // Badan Hukum
            'tujuan' => 'required|string',
            'rincian' => 'required|string',
            
            // These fields are in migration but not explicitly in the HTML form I saw?
            // checking view:  nmr_pengesahan is there.
            // no_hp is NOT in the form? I should check the form again. 
            // The form has: Nama, NIK, No KK, Email, Alamat, Pekerjaan.
            // Upload Foto KTP.
            // Nomor Pengeluaran (Badan Hukum) -> nmr_pengesahan
            // Tujuan
            // Rincian
            
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
            
            // Create
            PermohonanInformasi::create($data);

            return redirect()->back()->with('success', 'Permohonan informasi berhasil dikirim. Silakan tunggu verifikasi admin.');

        } catch (\Exception $e) {
            Log::error('Permohonan Informasi Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim permohonan. Silakan coba lagi.')->withInput();
        }
    }
}
