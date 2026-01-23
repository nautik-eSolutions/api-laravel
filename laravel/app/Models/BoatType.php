<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BoatType extends Model
{
    protected $table = "boat_type";

    protected $fillable=[
        'name'
    ];

    public function boats(): HasMany
    {
        return $this->hasMany(Boat::class);
    }


}
