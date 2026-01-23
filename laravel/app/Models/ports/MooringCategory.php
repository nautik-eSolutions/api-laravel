<?php

namespace App\Models\ports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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


}
