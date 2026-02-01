<?php

namespace App\Models\ports;

use App\Models\booking\PriceConfiguration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MooringCategory extends Model
{
    protected $table = 'mooring_categories';


    public function zones(): BelongsTo
    {
        return $this->belongsTo(Zone::class,'zone_id');
    }
    public function mooringDimensions(): BelongsTo
    {
        return $this->belongsTo(MooringDimensions::class);
    }

    public function moorings()
    {
        return $this->hasMany(Mooring::class);
    }

    public function priceConfigurations(){
        return $this->belongsToMany(PriceConfiguration::class,'mooring_zone_price_configuration');
    }

}