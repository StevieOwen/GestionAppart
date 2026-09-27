<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;
    protected $fillable=['id','type','service','price','created_at','updated_at'];

    public function serviceapparts():HasMany{
        return $this->hasMany(ServiceAppart::class);
    }
}
