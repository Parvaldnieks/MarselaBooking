<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['availability', 'rating', 'price', 'images'];

    protected $casts = [
        'images' => 'array', // Cast images as an array
    ];
}