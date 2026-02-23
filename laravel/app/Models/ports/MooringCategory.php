<?php

namespace App\Models\ports;

use App\Http\Resources\MooringCategoryResource;
use App\Models\booking\PriceConfiguration;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[UseResource(MooringCategoryResource::class)]
class MooringCategory extends Model
{
    protected $table = 'mooring_categories';

    protected $fillable = [
        'id',
        'zone_id',
        'mooring_dimensions_id'
    ];


    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class,'zone_id');
    }
    public function mooringDimension(): BelongsTo
    {
        return $this->belongsTo(MooringDimensions::class,'mooring_dimensions_id');
    }

    public function moorings()
    {
        return $this->hasMany(Mooring::class);
    }

    public function priceConfigurations(){
        return $this->belongsToMany(PriceConfiguration::class,'mooring_category_price_configuration');
    }

}