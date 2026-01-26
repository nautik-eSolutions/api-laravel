<?php

namespace App\Models\locations;

use App\Models\ports\Port;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    public $timestamps = false;

    protected $table = 'city';
    protected $fillable = [
        'name'
    ];

    public function community() : BelongsTo
    {
        return $this->belongsTo(Community::class);
    }

    public function ports ( ):HasMany
    {
        return $this->hasMany(Port::class);
    }


}
