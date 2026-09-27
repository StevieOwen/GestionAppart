<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Receipt extends Model
{
    /** @use HasFactory<\Database\Factories\ReceiptFactory> */
    use HasFactory;
    protected $fillable=['id','booking_id','created_at','updated_at'];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
    
}
