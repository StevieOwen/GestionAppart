<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;
    protected $fillable=['id','user_id','appartment_id','start_date','end_date','numbers_days','price','status','created_at','updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id', 'user_id');
    }

    public function appartment(): BelongsTo
    {
        return $this->belongsTo(Appartment::class);
    }

    public function receipts():HasOne{
        return $this->hasOne(Receipt::class);
    }
}
