<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display all notifications
     */
    public function index(): JsonResponse
    {
        $user = Auth::user();
        $notifications = Notification::where(function ($query) use ($user) {
            $query->where('to_user_id', $user->id)
                ->orWhere('to_skpd_id', $user->id_skpd);
        })
            ->latest()
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data'    => $notifications
        ], 200);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(string $id): JsonResponse
    {
        $notification = Notification::findOrFail($id);

        // Security check
        if ($notification->to_user_id !== Auth::id() && $notification->to_skpd_id !== Auth::user()->id_skpd) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $notification->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi ditandai sebagai dibaca.'
        ], 200);
    }

    /**
     * Delete notification
     */
    public function destroy(string $id): JsonResponse
    {
        $notification = Notification::findOrFail($id);

        // Security check
        if ($notification->to_user_id !== Auth::id() && $notification->to_skpd_id !== Auth::user()->id_skpd) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil dihapus.'
        ], 200);
    }

    /**
     * Mark all as read
     */
    public function markAllAsRead(): JsonResponse
    {
        $user = Auth::user();

        Notification::where(function ($query) use ($user) {
            $query->where('to_user_id', $user->id)
                ->orWhere('to_skpd_id', $user->id_skpd);
        })
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Semua notifikasi ditandai sebagai dibaca.'
        ], 200);
    }

    /**
     * Delete all notifications
     */
    public function deleteAll(): JsonResponse
    {
        $user = Auth::user();

        Notification::where(function ($query) use ($user) {
            $query->where('to_user_id', $user->id)
                ->orWhere('to_skpd_id', $user->id_skpd);
        })->delete();

        return response()->json([
            'success' => true,
            'message' => 'Semua notifikasi berhasil dihapus.'
        ], 200);
    }
}