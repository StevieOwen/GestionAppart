<?php

namespace App\Listeners;

use App\Events\BookingStatusChanged;
use App\Services\NotificationService;

class SendBookingStatusNotification
{
    public function __construct(
        protected NotificationService $notificationService
    ) {}

    public function handle(BookingStatusChanged $event): void
    {
        $this->notificationService->notifyBookingStatusChange(
            $event->booking,
            $event->status
        );
    }
}