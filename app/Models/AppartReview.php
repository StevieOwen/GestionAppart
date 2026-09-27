<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppartReview extends Model
{
    /** @use HasFactory<\Database\Factories\AppartReviewFactory> */
    use HasFactory;
    protected $fillable=['id','user_id','appartment_id','comment','grade','created_at','updated_at'];

    public function appartment(): BelongsTo
    {
        return $this->belongsTo(Appartment::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
