<?php

namespace App\Models\locations;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

    protected $table = 'city';
    protected $fillable = [
        'name'
    ];

    public function community () {
        return $this->belongsTo(Community::class);
    }


}
