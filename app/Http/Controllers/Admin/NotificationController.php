<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display all notifications
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = Notification::where(function ($query) use ($user) {
            $query->where('to_user_id', $user->id)
                ->orWhere('to_skpd_id', $user->id_skpd);
        })
            ->latest()
            ->paginate(15);

        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(string $id)
    {
        $notification = Notification::findOrFail($id);

        // Security check
        if ($notification->to_user_id !== Auth::id() && $notification->to_skpd_id !== Auth::user()->id_skpd) {
            abort(403);
        }

        $notification->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    /**
     * Delete notification
     */
    public function destroy(string $id)
    {
        $notification = Notification::findOrFail($id);

        // Security check
        if ($notification->to_user_id !== Auth::id() && $notification->to_skpd_id !== Auth::user()->id_skpd) {
            abort(403);
        }

        $notification->delete();

        return back()->with('success', 'Notifikasi berhasil dihapus.');
    }

    /**
     * Mark all as read
     */
    public function markAllAsRead()
    {
        $user = Auth::user();

        Notification::where(function ($query) use ($user) {
            $query->where('to_user_id', $user->id)
                ->orWhere('to_skpd_id', $user->id_skpd);
        })
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return back()->with('success', 'Semua notifikasi ditandai sebagai dibaca.');
    }

    /**
     * Delete all notifications
     */
    public function deleteAll()
    {
        $user = Auth::user();

        Notification::where(function ($query) use ($user) {
            $query->where('to_user_id', $user->id)
                ->orWhere('to_skpd_id', $user->id_skpd);
        })->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Semua notifikasi telah dihapus.');
    }
}
