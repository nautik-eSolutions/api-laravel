<?php

namespace App\Models\persons;

use App\Models\users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
