<?php

namespace App\Models\ports;

use App\Models\booking\PriceConfiguration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MooringCategory extends Model
{
    protected $table = 'mooring_category';
    public $timestamps = false;

    protected $fillable = [
        'max_length',
        'max_beam'
    ];


    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function moorings():HasMany
    {
        return $this->hasMany(Mooring::class);
    }

    public function priceConfigurations(): BelongsToMany
    {
        return $this->belongsToMany(PriceConfiguration::class,'mooring_category_price_configuration');
    }


}
