<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiSertaMerta;
use Illuminate\Http\Request;

class InformasiSertaMertaController extends Controller
{
    public function index(Request $request)
    {
        $query = InformasiSertaMerta::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('a', 'like', "%{$search}%")
                    ->orWhere('b', 'like', "%{$search}%");
            });
        }

        $items = $query->paginate(10);

        return view('admin.informasi-serta-merta.index', compact('items'));
    }

    public function create()
    {
        return view('admin.informasi-serta-merta.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'a' => 'nullable|string|max:255',
            'b' => 'nullable|string|max:255',
            'c' => 'nullable|string|max:255',
            'd' => 'nullable|string|max:255',
            'e' => 'nullable|string|max:255',
            'f' => 'nullable|string|max:255',
            'g' => 'nullable|string|max:255',
            'h' => 'nullable|string|max:255',
        ]);

        InformasiSertaMerta::create($validated);

        return redirect()->route('admin.informasi-serta-merta.index')
            ->with('success', 'Informasi Serta Merta berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $item = InformasiSertaMerta::findOrFail($id);
        return view('admin.informasi-serta-merta.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $item = InformasiSertaMerta::findOrFail($id);

        $validated = $request->validate([
            'a' => 'nullable|string|max:255',
            'b' => 'nullable|string|max:255',
            'c' => 'nullable|string|max:255',
            'd' => 'nullable|string|max:255',
            'e' => 'nullable|string|max:255',
            'f' => 'nullable|string|max:255',
            'g' => 'nullable|string|max:255',
            'h' => 'nullable|string|max:255',
        ]);

        $item->update($validated);

        return redirect()->route('admin.informasi-serta-merta.index')
            ->with('success', 'Informasi Serta Merta berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $item = InformasiSertaMerta::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.informasi-serta-merta.index')
            ->with('success', 'Informasi Serta Merta berhasil dihapus.');
    }
}
