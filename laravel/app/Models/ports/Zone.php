<?php

namespace App\Models\ports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Zone extends Model
{
    public $timestamps =  false;
    protected $table = 'zone';

    protected $fillable = [
        'name',
        'description'
    ];

    public function port():BelongsTo
    {
        return $this->belongsTo(Port::class);
    }


}
