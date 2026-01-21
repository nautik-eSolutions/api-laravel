<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
