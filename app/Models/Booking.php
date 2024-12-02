<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * 
     */

     protected $table = 'bookings';
     protected $fillable = [
        'user_id', 
        'room_id', 
        'subject', 
        'start_time', 
        'end_time', 
        'day_of_week',
         'status', 
         'book_until'
    ];
}
