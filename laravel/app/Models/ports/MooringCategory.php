<?php

namespace App\Models\ports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MooringCategory extends Model
{
    protected $table = 'mooring_categories';


    public function zones(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }
    public function mooringDimensions(): BelongsTo
    {
        return $this->belongsTo(MooringDimensions::class);
    }

    public function moorings()
    {
        return $this->hasMany(Mooring::class);
    }

}