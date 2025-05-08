<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
class Event extends Model
{
    protected $table = "events";

    // An event can have many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
