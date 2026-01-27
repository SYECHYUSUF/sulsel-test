<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanKeberatanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required',
            'tujuan' => 'required',
            'nama_pemohon' => 'required',
            'alamat_pemohon' => 'required',
            'address_pemohon' => 'required',
            'city_pemohon' => 'required',
            'state_pemohon' => 'required',
            'pekerjaan_pemohon' => 'required',
            'no_telp_pemohon' => 'required',
            'email_pemohon' => 'required|email',
            'alasan' => 'required|array|min:1',
            'kasus' => 'required',
        ]);

        // Cari Data Permohonan Asli untuk mendapatkan ID SKPD
        $permohonan = \App\Models\PermohonanInformasi::where('no_pendaftaran', $request->no_pendaftaran)->first();
        $id_skpd = $permohonan ? $permohonan->id_skpd : null;

        $pengajuan = \App\Models\PengajuanKeberatan::create([
            'no_pendaftaran' => $request->no_pendaftaran,
            'id_skpd' => $id_skpd, // Save ID SKPD
            'tujuan' => $request->tujuan,
            'nama_pemohon' => $request->nama_pemohon,
            'alamat_pemohon' => $request->alamat_pemohon,
            'address_pemohon' => $request->address_pemohon,
            'apt_pemohon' => $request->apt_pemohon,
            'city_pemohon' => $request->city_pemohon,
            'state_pemohon' => $request->state_pemohon,
            'pekerjaan_pemohon' => $request->pekerjaan_pemohon,
            'no_telp_pemohon' => $request->no_telp_pemohon,
            'email_pemohon' => $request->email_pemohon,
            // Kuasa (Optional)
            'nama_kuasa' => $request->nama_kuasa,
            'alamat_kuasa' => $request->alamat_kuasa,
            'address_kuasa' => $request->address_kuasa,
            'apt_kuasa' => $request->apt_kuasa,
            'city_kuasa' => $request->city_kuasa,
            'state_kuasa' => $request->state_kuasa,
            'no_telp_kuasa' => $request->no_telp_kuasa,
            'kasus' => $request->kasus,
            'status' => 'n', // New
        ]);

        foreach ($request->alasan as $alasan) {
            \App\Models\AlasanPengajuan::create([
                'id_pengajuan' => $pengajuan->id_pengajuan,
                'alasan' => $alasan,
            ]);
        }

        return back()->with('success', 'Pengajuan keberatan berhasil dikirim.');
    }
    public function checkStatus(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required',
            'email' => 'required|email'
        ]);

        $pengajuan = \App\Models\PengajuanKeberatan::with(['feedbackBy', 'alasanPengajuan'])
            ->where('no_pendaftaran', $request->no_pendaftaran)
            ->where('email_pemohon', $request->email)
            ->first();

        if (!$pengajuan) {
            return back()->with('error', 'Data pengajuan tidak ditemukan. Periksa kembali Nomor Pendaftaran dan Email Anda.');
        }

        return view('pages.layanan.detail-status-keberatan', compact('pengajuan'));
    }

    public function formCheckStatus()
    {
        return view('pages.layanan.cek-status-keberatan');
    }
}
