protected $listen = [
    \App\Events\BookingStatusChanged::class => [
        \App\Listeners\SendBookingStatusNotification::class,
    ],
];