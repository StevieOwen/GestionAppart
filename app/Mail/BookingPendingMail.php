<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingPendingMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $booking;
    public $managerPhone;

    public function __construct(Booking $booking, string $managerPhone)
    {
        $this->booking = $booking;
        $this->managerPhone = $managerPhone;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Confirmation - Pending Payment',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_pending',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}