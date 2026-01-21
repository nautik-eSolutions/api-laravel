<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Owner extends Model
{
    protected $table = 'owner';

    public function person(): BelongsTo
    {
        return $this->hasOne(Person::class);
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'user_owner');
    }

}
