<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;
    protected $fillable=['id','img','appartment_id','created_at','updated_at'];

    public function appartment(): BelongsTo
    {
        return $this->belongsTo(Appartment::class);
    }

}
