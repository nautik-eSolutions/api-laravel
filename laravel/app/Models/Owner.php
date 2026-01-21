<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Owner extends Model
{
    protected $table = 'owner';


    public $timestamps =false;

    public function person()
    {
        return $this->hasOne(Person::class,'person_id');
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'user_owner');
    }

}
