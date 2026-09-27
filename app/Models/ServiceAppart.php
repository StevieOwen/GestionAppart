<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceAppart extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceAppartFactory> */
    use HasFactory;
    protected $fillable=['id','appartment_id','service_id','created_at','updated_at'];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function appartment(): BelongsTo
    {
        return $this->belongsTo(Appartment::class);
    }
}
