<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Dispatch a custom notification to a specific user.
     */
    public function send(User $user, string $type, string $title, string $message, array $data = []): Notification
    {
        return Notification::create([
            'user_id' => $user->user_id ?? $user->id,
            'type'    => $type,
            'title'   => $title,
            'message' => $message,
            'data'    => $data,
        ]);
    }

    /**
     * Trigger notification based on booking status change.
     */
    public function notifyBookingStatusChange(Booking $booking, string $status): ?Notification
    {
        $customer = $booking->user;
        $apartmentName = $booking->appartment->appart_designation ?? 'Apartment';

        [$title, $message] = match ($status) {
            'processing' => [
                'Booking Request Received',
                "Your reservation request for {$apartmentName} is now being processed."
            ],
            'confirmed' => [
                'Booking Confirmed!',
                "Great news! Your reservation for {$apartmentName} starting on " . $booking->start_date->format('M d, Y') . " has been confirmed."
            ],
            'cancelled' => [
                'Booking Cancelled',
                "Your reservation for {$apartmentName} has been cancelled."
            ],
            default => [null, null]
        };

        if (!$title) {
            return null;
        }

        return $this->send(
            user: $customer,
            type: "booking_{$status}",
            title: $title,
            message: $message,
            data: [
                'booking_id'    => $booking->id,
                'appartment_id' => $booking->appartment_id,
                'status'        => $status,
                'action_url'    => route('customer.bookings.index'),
            ]
        );
    }
}