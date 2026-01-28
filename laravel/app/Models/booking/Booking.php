<?php

namespace App\Models\booking;

use App\Models\boats\Boat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    public $timestamps = false;

    protected $table = 'booking';

    protected $fillable = [
        'start_date',
        'end_date',
        'total_cost',
        'payment_method',
        'boat_id',
    ];

    public function boat(): BelongsTo
    {
        return $this->belongsTo(Boat::class);
    }

    public function bookingStatus(): BelongsTo
    {
        return $this->belongsTo(BookingStatus::class);
    }

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }
}
