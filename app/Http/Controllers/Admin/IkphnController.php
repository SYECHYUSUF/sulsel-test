<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ikphn;
use App\Models\Notification;
use App\Models\Skpd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IkphnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Ikphn::with('skpd');

        // Filter by SKPD (Role based or Request based)
        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        } elseif ($request->filled('id_skpd') && $user->hasRole('admin')) {
            $query->where('id_skpd', $request->id_skpd);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('nama_jabatan', 'like', '%' . $request->search . '%');
        }

        // Filter Verify
        if ($request->filled('verify')) {
            $query->where('verify', $request->verify);
        }

        // Filter Date
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Sort
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->oldest();
                    break;
                case 'title_asc':
                    $query->orderBy('nama_jabatan', 'asc');
                    break;
                case 'title_desc':
                    $query->orderBy('nama_jabatan', 'desc');
                    break;
                case 'newest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $items = $query->paginate(10);

        $skpdList = $user->hasRole('opd')
            ? Skpd::where('id_skpd', $user->id_skpd)->get()
            : Skpd::orderBy('nm_skpd')->get();

        return view('admin.ikphn.index', compact('items', 'skpdList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $skpdList = $user->hasRole('opd')
            ? Skpd::where('id_skpd', $user->id_skpd)->get()
            : Skpd::orderBy('nm_skpd')->get();

        return view('admin.ikphn.create', compact('skpdList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
            'id_skpd' => 'required',
            'verify' => 'nullable|in:y,n,t',
        ]);

        $data = $request->all();
        $data['verify'] = $request->input('verify', 'n');
        $data['jumlah_download'] = 0;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('ikphn', 'public');
            $data['file'] = $path;
        }

        $ikphn = Ikphn::create($data);

        // Notify Admins if created by OPD
        if (Auth::user()->hasRole('opd')) {
            $admins = User::whereHasRole('admin')->get();
            foreach ($admins as $admin) {
                Notification::send([
                    'to_user_id' => $admin->id,
                    'type' => 'info',
                    'title' => 'IKPHN Baru',
                    'message' => 'OPD ' . Auth::user()->skpd->nm_skpd . ' telah mengunggah IKPHN baru: ' . $ikphn->nama_jabatan,
                    'url' => route('admin.ikphns.edit', $ikphn->id), // Direct to edit for verification
                    'notifiable_id' => $ikphn->id,
                    'notifiable_type' => get_class($ikphn),
                ]);
            }
        }

        return redirect()->route('admin.ikphns.index')
            ->with('success', 'Data Informasi Pengadaan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $item = Ikphn::findOrFail($id);

        // Security check for OPD
        if ($user->hasRole('opd') && $item->id_skpd !== $user->id_skpd) {
            abort(403);
        }

        $skpdList = $user->hasRole('opd')
            ? Skpd::where('id_skpd', $user->id_skpd)->get()
            : Skpd::orderBy('nm_skpd')->get();

        return view('admin.ikphn.edit', compact('item', 'skpdList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Ikphn::findOrFail($id);

        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
            'id_skpd' => 'required',
            'verify' => 'required|in:y,n,t',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            if ($item->file && Storage::disk('public')->exists($item->file)) {
                Storage::disk('public')->delete($item->file);
            }

            $file = $request->file('file');
            $path = $file->store('ikphn', 'public');
            $data['file'] = $path;
        }

        $item->update($data);

        // Notify OPD user if verify status changed and user is admin
        if (Auth::user()->hasRole('admin') && $item->wasChanged('verify')) {
            $statusText = match ($item->verify) {
                'y' => 'Terverifikasi',
                'n' => 'Pending',
                't' => 'Ditolak',
            };

            $type = match ($item->verify) {
                'y' => 'success',
                'n' => 'info',
                't' => 'error',
            };

            // Notify the SKPD owner
            // Assuming we notify by skpd_id since we don't track specific user uploader easily without user_id in table
            // But we can use to_skpd_id
            Notification::send([
                'to_skpd_id' => $item->id_skpd,
                'type' => $type,
                'title' => 'Status IKPHN: ' . $statusText,
                'message' => 'Data IKPHN "' . $item->nama_jabatan . '" telah ' . strtolower($statusText) . ' oleh admin.',
                'url' => route('admin.ikphns.edit', $item->id),
                'notifiable_id' => $item->id,
                'notifiable_type' => get_class($item),
            ]);
        }

        return redirect()->route('admin.ikphns.index')
            ->with('success', 'Data Informasi Pengadaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Ikphn::findOrFail($id);

        if ($item->file && Storage::disk('public')->exists($item->file)) {
            Storage::disk('public')->delete($item->file);
        }

        $item->delete();

        return redirect()->route('admin.ikphns.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
