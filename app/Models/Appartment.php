<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appartment extends Model
{
    /** @use HasFactory<\Database\Factories\AppartmentFactory> */
    use HasFactory;
    protected $fillable=['id','building_id','appartment_designation','rooms','price','available','created_at','updated_at'];

    public function bookings(): HasMany{
        return $this->hasMany(Booking::class, 'appartment_id');
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function images():HasMany{
        return $this->hasMany(Image::class);
    }

    public function appartreviews():HasMany{
        return $this->hasMany(AppartReview::class);
    }
    public function serviceapparts():HasMany{
        return $this->hasMany(ServiceAppart::class);
    }

}