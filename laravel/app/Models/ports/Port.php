<?php

namespace App\Models\ports;

use App\Models\locations\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Port extends Model
{

    public $timestamps = false;

    protected $table = 'port';

    protected $fillable = [
        'name',
    ];

    public function city():BelongsTo
    {
        return $this->belongsTo(City::class);
    }


}
