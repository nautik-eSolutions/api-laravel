<?php

namespace App\Models\ports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortImage extends Model
{

    protected $table = 'port_image';
    protected $fillable = ['port_id', 'image_key'];

    public function port()
    {
        return $this->belongsTo(Port::class);
    }

}