<?php

namespace App\Models\booking;

use App\Models\ports\MooringDimensions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use mysql_xdevapi\TableInsert;

class PriceConfiguration extends Model
{
    public $timestamps = false;

    protected $table = 'price_configuration';

    protected $fillable =[
        'min_price',
        'start_date',
        'end_date'
    ];
    public function casts()
    {
        return[
            'start_date'=>'date',
            'end_date'=>'date'
        ];
    }

    public function mooringCategories(): BelongsToMany
    {
    return $this->belongsToMany(MooringDimensions::class,'mooring_category_price_configuration');
    }
}

