<?php

// app/Models/Booking.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'human_id',
        'reservation_date',
        // Add more fields as needed
    ];

    // Define relationships

    public function human()
    {
        return $this->belongsTo(Human::class);
    }

    // You can add more relationships here as needed
}