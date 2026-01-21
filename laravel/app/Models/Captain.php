<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Captain extends Model
{
    protected $table = 'captain';


    protected $fillable = [
        'navigation_license'=>'string'
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
