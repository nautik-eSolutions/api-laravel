<?php

namespace App\Models\locations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Community extends Model
{
    public $timestamps = false;

    protected $table = 'community';
    protected $fillable = [
        'name'
    ];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
