<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Boat extends Model
{
    protected $table =  'boat';

    protected $guarded = [];
    public $timestamps = false;
    protected $fillable = [
        'name',
        'registry_number',
        'length',
        'beam',
        'draft'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function boatType(): BelongsTo
    {
        return $this->belongsTo(BoatType::class);
    }

}
