<?php

namespace App\Models\persons;

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
        'identification_document_type',
        'isOwner',
        'navigation_license',
        'isCaptain'
    ];

    protected function casts()
    {
        return [
            'birth_date' => 'date',
        ];
    }

}
