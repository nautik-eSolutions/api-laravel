<?php

namespace App\Models\booking;

use App\Models\ports\Mooring;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MooringStatus extends Model
{
    public $timestamps = false;

    protected $table = 'mooring_status';

    protected $fillable = [
        'status'
    ];


    public function moorings():BelongsToMany
    {
        return $this->belongsToMany(Mooring::class,'mooring_mooring_status');
    }
}
