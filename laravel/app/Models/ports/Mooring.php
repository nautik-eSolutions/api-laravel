<?php

namespace App\Models\ports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mooring extends Model
{
    public $timestamps =  false;
    protected $table = 'mooring';

    protected $fillable = [
      'number'
    ];


    public function mooringCategory():BelongsTo
    {
        return $this->belongsTo(MooringCategory::class);
    }

}
