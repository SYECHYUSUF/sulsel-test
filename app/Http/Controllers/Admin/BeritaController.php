<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Skpd;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Berita::with('skpd'); // Eager Loading untuk mencegah N+1

        // Filter otomatis jika role adalah 'opd'
        // Pastikan tabel 'tbl_berita' memiliki kolom 'id_skpd'
        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('verify')) {
            $query->where('verify', $request->verify);
        }

        $berita = $query->latest('tgl_upload')->paginate(10);

        // Jika request meminta JSON
        if ($request->expectsJson()) {
            return response()->json($berita);
        }

        $skpdList = Skpd::all();
        return view('admin.berita.index', compact('skpdList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        // Jika user adalah OPD, hanya ambil SKPD miliknya. Jika admin, ambil semua.
        $skpdList = $user->hasRole('opd') 
            ? Skpd::where('id_skpd', $user->id_skpd)->get() 
            : Skpd::orderBy('nm_skpd')->get();

        return view('admin.berita.create', compact('skpdList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'id_skpd' => 'required',
            'img_berita' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'verify' => 'required|in:y,n,t',
        ]);

        $data = $request->all();

        // Generate Slug Otomatis
        $data['slug'] = Str::slug($request->judul) . '-' . rand(100, 999);
        
        // Set Default Viewers
        $data['viewers'] = 0;

        // Handle Upload Gambar
        if ($request->hasFile('img_berita')) {
            $file = $request->file('img_berita');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('img_berita', $filename, 'public');
            $data['img_berita'] = $filename;
        }

        // Simpan ke Database
        $berita = Berita::create($data);

        // Notify Admins if created by OPD
        if (Auth::user()->hasRole('opd')) {
            $admins = User::whereHasRole('admin')->get();
            foreach ($admins as $admin) {
                Notification::send([
                    'to_user_id' => $admin->id,
                    'type' => 'info',
                    'title' => 'Berita Baru',
                    'message' => 'OPD ' . Auth::user()->skpd->nm_skpd . ' telah menambahkan berita baru: ' . $berita->judul,
                    'url' => route('admin.berita.edit', $berita->id_berita),
                    'notifiable_id' => $berita->id_berita,
                    'notifiable_type' => get_class($berita),
                ]);
            }
        }

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $berita = Berita::findOrFail($id);
        $skpdList = Skpd::orderBy('nm_skpd')->get();
        return view('admin.berita.edit', compact('berita', 'skpdList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'img_berita' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_skpd' => 'required|exists:tbl_skpd,id_skpd',
            'verify' => 'required|in:y,n,t',
        ]);

        $data = $request->except('img_berita');
        $data['slug'] = Str::slug($request->judul) . '-' . rand(100, 999);

        if ($request->hasFile('img_berita')) {
            // Hapus gambar lama jika ada
            if ($berita->img_berita && Storage::disk('public')->exists('img_berita/' . $berita->img_berita)) {
                Storage::disk('public')->delete('img_berita/' . $berita->img_berita);
            }

            $file = $request->file('img_berita');
            $filename = $file->hashName();
            $file->storeAs('img_berita', $filename, 'public');
            $data['img_berita'] = $filename;
        }

        $berita->update($data);

        // Notify OPD user if verify status changed and user is admin
        if (Auth::user()->hasRole('admin') && $berita->wasChanged('verify')) {
            $statusText = match ($berita->verify) {
                'y' => 'Terverifikasi',
                'n' => 'Pending',
                't' => 'Ditolak',
            };

            $type = match ($berita->verify) {
                'y' => 'success',
                'n' => 'info',
                't' => 'error',
            };

            // Notify the SKPD owner
            Notification::send([
                'to_skpd_id' => $berita->id_skpd,
                'type' => $type,
                'title' => 'Status Berita: ' . $statusText,
                'message' => 'Berita "' . $berita->judul . '" telah ' . strtolower($statusText) . ' oleh admin.',
                'url' => route('admin.berita.edit', $berita->id_berita),
                'notifiable_id' => $berita->id_berita,
                'notifiable_type' => get_class($berita),
            ]);
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->img_berita && Storage::disk('public')->exists('img_berita/' . $berita->img_berita)) {
            Storage::disk('public')->delete('img_berita/' . $berita->img_berita);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
