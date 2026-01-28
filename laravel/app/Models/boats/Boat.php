<?php

namespace App\Models\boats;

use App\Models\booking\Booking;
use App\Models\persons\Person;
use App\Models\users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Boat extends Model
{
    protected $table =  'boat';

    protected $guarded = [];
    public $timestamps = false;
    protected $fillable = [
        'name',
        'registry_number',
        'length',
        'beam',
        'draft'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function boatType(): BelongsTo
    {
        return $this->belongsTo(BoatType::class);
    }

    public function bookings ( ): HasMany
    {
        return $this->hasMany(Booking::class);
    }

}
