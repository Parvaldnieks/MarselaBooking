<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Human extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'phone',
        // Add more fields as needed
    ];

    // Define relationships

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}