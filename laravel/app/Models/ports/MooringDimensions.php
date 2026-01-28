<?php

namespace App\Models\ports;

use App\Models\booking\PriceConfiguration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use phpDocumentor\Reflection\Types\This;

class MooringDimensions extends Model
{
    protected $table = 'mooring_dimensions';
    public $timestamps = false;

    protected $fillable = [
        'max_length',
        'max_beam'
    ];


    public function MooringCategory() : HasMany
    {
        return $this->HasMany(MooringCategory::class);
    }

    public function priceConfigurations(): BelongsToMany
    {
        return $this->belongsToMany(PriceConfiguration::class,'mooring_category_price_configuration');
    }


}
