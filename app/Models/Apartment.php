<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'availability', 'rating', 'price', 'image_urls',
    ];

    protected $casts = [
        'image_urls' => 'array', // Ensure image_urls is cast to array
    ];
}