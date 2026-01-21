<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Owner extends Model
{
    protected $table = 'owner';

    public function person() : BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

}
