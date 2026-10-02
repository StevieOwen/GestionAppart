<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 25px; border-radius: 8px;">
        <h2 style="color: #0284c7;">Your Booking Request Has Been Received!</h2>
        
        <p>Dear {{ $booking->user->name ?? 'Guest' }},</p>

        <p>Thank you for making a reservation with StayHub. Your booking is currently <strong>processing</strong>.</p>

        <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 6px; margin: 20px 0;">
            <h3 style="margin-top: 0; color: #0f172a;">Booking Details</h3>
            <p><strong>Apartment:</strong> {{ $booking->appartment->appart_designation }}</p>
            <p><strong>Check-in:</strong> {{ $booking->start_date }}</p>
            <p><strong>Check-out:</strong> {{ $booking->end_date }}</p>
            <p><strong>Duration:</strong> {{ $booking->number_days }} night(s)</p>
            <p><strong>Total Amount:</strong> ${{ number_format($booking->price, 2) }}</p>
            <p><strong>Status:</strong> <span style="color: #d97706; font-weight: bold;">Processing</span></p>
        </div>

        <div style="background: #fffbe3; border-left: 4px solid #f59e0b; padding: 15px; margin: 20px 0;">
            <h4 style="margin-top: 0; color: #b45309;">Payment Instructions</h4>
            <p>To confirm your reservation, please send the payment directly to the apartment manager at:</p>
            <p style="font-size: 18px; font-weight: bold; color: #0f172a;">
                📞 Phone Number: {{ $managerPhone }}
            </p>
            <p style="font-size: 13px; color: #64748b;">Once the manager receives your payment, your booking status will be updated to confirmed.</p>
        </div>

        <p>If you have any questions, feel free to contact the manager directly.</p>

        <p>Best regards,<br>The StayHub Team</p>
    </div>
</body>
</html>