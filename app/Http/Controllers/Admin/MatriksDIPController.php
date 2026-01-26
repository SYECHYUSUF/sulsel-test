<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MatriksDip;
use Illuminate\Http\Request;

class MatriksDIPController extends Controller
{
    public function index(Request $request)
    {
        $query = MatriksDip::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('a', 'like', "%{$search}%")
                    ->orWhere('b', 'like', "%{$search}%");
            });
        }

        $items = $query->paginate(10);

        return view('admin.matriks-dip.index', compact('items'));
    }

    public function create()
    {
        return view('admin.matriks-dip.create');
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

        MatriksDip::create($validated);

        return redirect()->route('admin.matriks-dip.index')
            ->with('success', 'Informasi Daftar Publik berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $item = MatriksDip::findOrFail($id);
        return view('admin.matriks-dip.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $item = MatriksDip::findOrFail($id);

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

        return redirect()->route('admin.matriks-dip.index')
            ->with('success', 'Informasi Daftar Publik berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $item = MatriksDip::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.matriks-dip.index')
            ->with('success', 'Informasi Daftar Publik berhasil dihapus.');
    }
}
