<?php

namespace App\Models\ports;

use App\Models\booking\MooringStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mooring extends Model
{
    public $timestamps =  false;
    protected $table = 'mooring';

    protected $fillable = [
      'number'
    ];


    public function mooringCategory():BelongsTo
    {
        return $this->belongsTo(MooringDimensions::class);
    }

    public function bookings (): BelongsToMany
    {
        return $this->belongsToMany(Mooring::class,'mooring_booking');
    }

    public function mooringStatuses()
    {
        return $this->belongsToMany(MooringStatus::class, 'mooring_mooring_status');
    }



}
