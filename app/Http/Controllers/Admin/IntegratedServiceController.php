<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IntegratedService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IntegratedServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = IntegratedService::latest()->paginate(10);
        return view('admin.integrated-services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.integrated-services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'link' => 'required|url|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'link', 'is_active']);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('integrated_services', $filename, 'public');
            $data['icon'] = $filename;
        }

        IntegratedService::create($data);

        return redirect()->route('admin.integrated-services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IntegratedService $integratedService)
    {
        return view('admin.integrated-services.edit', compact('integratedService'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IntegratedService $integratedService)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'link' => 'required|url|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'link', 'is_active']);

        if ($request->hasFile('icon')) {
            // Delete old icon
            if ($integratedService->icon && Storage::disk('public')->exists('integrated_services/' . $integratedService->icon)) {
                Storage::disk('public')->delete('integrated_services/' . $integratedService->icon);
            }

            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('integrated_services', $filename, 'public');
            $data['icon'] = $filename;
        }

        $integratedService->update($data);

        return redirect()->route('admin.integrated-services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IntegratedService $integratedService)
    {
        if ($integratedService->icon && Storage::disk('public')->exists('integrated_services/' . $integratedService->icon)) {
            Storage::disk('public')->delete('integrated_services/' . $integratedService->icon);
        }

        $integratedService->delete();

        return redirect()->route('admin.integrated-services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
