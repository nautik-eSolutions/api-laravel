<?php

namespace App\Models\ports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zone extends Model
{
    public $timestamps = false;
    protected $table = 'zone';

    protected $fillable = [
        'name',
        'description'
    ];

    public function port(): BelongsTo
    {
        return $this->belongsTo(Port::class);
    }

    public function mooringCategories(): BelongsToMany
    {
        return $this->BelongsToMany(MooringCategory::class,'zone_mooring_categories');
    }


}
