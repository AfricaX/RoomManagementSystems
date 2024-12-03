<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    //
    protected $table = 'rooms';

    protected $fillable = [
        'room_name',
        'room_type',
        'location',
        'description',
        'capacity',
        'image',
    ];

    public function user(){
    return $this->belongsTo(User::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
