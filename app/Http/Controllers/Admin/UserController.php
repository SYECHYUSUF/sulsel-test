<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna beserta relasi SKPD.
     */
    public function index(Request $request): JsonResponse
    {
        $query = User::with('skpd', 'lastLogin');

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('username', 'like', $searchTerm);
            });
        }

        $users = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $users
        ], 200);
    }

    /**
     * Menampilkan detail data pengguna berdasarkan ID.
     */
    public function show(string $id): JsonResponse
    {
        // Mencari user beserta relasi yang dibutuhkan
        $user = User::with(['skpd', 'lastLogin'])->find($id);

        // Jika user tidak ditemukan, kembalikan response 404
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.'
            ], 404);
        }

        // Kembalikan data user dalam format JSON
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    /**
     * Mendaftarkan pengguna baru ke sistem.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'id_skpd' => 'nullable|exists:tbl_skpd,id_skpd',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_skpd' => $request->id_skpd,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil ditambahkan.',
            'data' => $user
        ], 201);
    }

    /**
     * Memperbarui profil pengguna.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8',
            'id_skpd' => 'nullable|exists:tbl_skpd,id_skpd',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['name', 'username', 'email', 'id_skpd']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil diperbarui.',
            'data' => $user
        ], 200);
    }

    /**
     * Menghapus akun pengguna (Dilarang menghapus diri sendiri).
     */
    public function destroy(string $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan.'], 404);
        }

        if ($user->id === Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat menghapus akun Anda sendiri.'
            ], 422);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus.'
        ], 200);
    }

    /**
     * Mengubah password pengguna. Tidak perlu pengecekan password lama karena hanya diakses melalui admin
     */
    public function changePassword(Request $request, string $id): JsonResponse
    {
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['success' => false, 'message' => 'User bukan sebagai admin.'], 401);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $user->update(['password' => Hash::make($request->new_password)]);
        $user->tokens()->delete(); 

        return response()->json(['success' => true, 'message' => 'Password berhasil diubah. User harus login ulang.']);
    }
}