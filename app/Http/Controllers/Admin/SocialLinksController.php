<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sosmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialLinksController extends Controller
{
    /**
     * Get all social links for admin
     */
    public function index()
    {
        try {
            $socialLinks = Sosmed::orderBy('urutan')->get();
            
            return response()->json([
                'success' => true,
                'data' => $socialLinks,
                'predefinedIcons' => Sosmed::getPredefinedIcons()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data social links',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store new social link
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nm_sosmed' => 'required|string|max:255',
            'link_sosmed' => 'required|url|max:255',
            'icon_sosmed' => 'required|string',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|in:0,1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Get max urutan if not provided
            $urutan = $request->urutan ?? (Sosmed::max('urutan') + 1);

            $socialLink = Sosmed::create([
                'nm_sosmed' => $request->nm_sosmed,
                'link_sosmed' => $request->link_sosmed,
                'icon_sosmed' => $request->icon_sosmed,
                'urutan' => $urutan,
                'is_active' => $request->is_active ?? '1'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Social link berhasil ditambahkan',
                'data' => $socialLink
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan social link',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update social link
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nm_sosmed' => 'sometimes|required|string|max:255',
            'link_sosmed' => 'sometimes|required|url|max:255',
            'icon_sosmed' => 'sometimes|required|string',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|in:0,1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $socialLink = Sosmed::find($id);

            if (!$socialLink) {
                return response()->json([
                    'success' => false,
                    'message' => 'Social link tidak ditemukan'
                ], 404);
            }

            $socialLink->update($request->only([
                'nm_sosmed',
                'link_sosmed',
                'icon_sosmed',
                'urutan',
                'is_active'
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Social link berhasil diperbarui',
                'data' => $socialLink
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui social link',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete social link
     */
    public function destroy($id)
    {
        try {
            $socialLink = Sosmed::find($id);

            if (!$socialLink) {
                return response()->json([
                    'success' => false,
                    'message' => 'Social link tidak ditemukan'
                ], 404);
            }

            $socialLink->delete();

            return response()->json([
                'success' => true,
                'message' => 'Social link berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus social link',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update order of social links
     */
    public function updateOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'items' => 'required|array',
            'items.*.id' => 'required|exists:tbl_sosmed,id_sosmed',
            'items.*.urutan' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            foreach ($request->items as $item) {
                Sosmed::where('id_sosmed', $item['id'])->update([
                    'urutan' => $item['urutan']
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Urutan social links berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui urutan social links',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
