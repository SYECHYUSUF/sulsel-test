<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ikphn;
use App\Models\Skpd;
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

        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        if ($request->filled('search')) {
            $query->where('nama_jabatan', 'like', '%' . $request->search . '%');
        }

        $items = $query->latest()->paginate(10);

        return view('admin.ikphn.index', compact('items'));
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

        Ikphn::create($data);

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
