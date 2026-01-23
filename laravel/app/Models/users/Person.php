<?php

namespace App\Models\users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
    public $timestamps = false;

    protected $table = 'person';

    protected $fillable = [
        'first_name',
        'last_name',
        'identification_document',
        'birth_date',
        'identification_document_type'
    ];

    protected function casts()
    {
        return [
            'birth_date' => 'date',
        ];
    }

    public function owner():HasOne
    {
        return $this->hasOne(Owner::class);
    }

    public function captain():HasOne{
        return $this->hasOne(Captain::class);
    }
}
