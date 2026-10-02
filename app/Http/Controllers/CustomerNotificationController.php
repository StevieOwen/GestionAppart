<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Appartment;
use App\Models\Building;
use Illuminate\Support\Facades\DB;
use App\Events\BookingStatusChanged;

class CustomerNotificationController extends Controller
{
    /**
     * Display a listing of user notifications with optional filtering.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = $user->notifications();

        // Filter by unread status if requested
        if ($request->query('filter') === 'unread') {
            $query->unread();
        }

        $notifications = $query->latest()->paginate(10);
        $unreadCount = $user->notifications()->unread()->count();
        $totalCount = $user->notifications()->count();

        return view('customer.notifications.index', compact('notifications', 'unreadCount', 'totalCount'));
    }

    /**
     * Mark a specific notification as read and redirect to its action URL if available.
     */
    public function markAsRead(Notification $notification)
    {
        $userId = auth()->user()->user_id ?? auth()->id();

        if ($notification->user_id !== $userId) {
            abort(403);
        }

        $notification->markAsRead();

        // Redirect to target URL if specified in metadata payload
        if (!empty($notification->data['action_url'])) {
            return redirect($notification->data['action_url']);
        }

        return back()->with('success', 'Notification marked as read.');
    }

    /**
     * Mark all unread notifications as read for the authenticated user.
     */
    public function markAllAsRead()
    {
        auth()->user()->notifications()->unread()->update([
            'read_at' => now(),
        ]);

        return back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Delete a notification.
     */
    public function destroy(Notification $notification)
    {
        $userId = auth()->user()->user_id ?? auth()->id();

        if ($notification->user_id !== $userId) {
            abort(403);
        }

        $notification->delete();

        return back()->with('success', 'Notification deleted.');
    }
}
