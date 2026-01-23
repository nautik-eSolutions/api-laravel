<?php

namespace App\Models\users;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Captain extends Model
{
    protected $table = 'captain';

    public $timestamps =false;
    protected $fillable = [
        'navigation_license' => 'string',
    ];
    protected $guarded = [];

    protected function navigationLicense(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function person():BelongsTo{
        return $this->hasOne(Person::class);
    }
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_captain');
    }

}
