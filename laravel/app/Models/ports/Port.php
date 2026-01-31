<?php

namespace App\Models\ports;

use App\Http\Resources\PortResource;
use App\Models\locations\City;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[UseResource(PortResource::class)]
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

    public function zones():HasMany{
        return $this->hasMany(Zone::class);
    }

}
