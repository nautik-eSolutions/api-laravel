<?php

namespace App\Models\booking;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookingStatus extends Model
{
    public $timestamps = false;

    protected $table = 'booking_status';

    protected $fillable = [
        'status',
    ];

    public function bookings() : HasMany
    {
        return $this->hasMany(Booking::class);
    }


}
