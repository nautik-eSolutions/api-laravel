<?php

namespace App\Http\Requests\persons;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PersonPatchRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "firstName"=>'max:20|min:2',
            "lastName"=>'max:20|min:2',
            "identificationDocument"=>'max:20|min:2',
            "birthDate"=>'date',
            "identificationDocumentType"=>[Rule::in('DNI','NIE','Passaporte')]
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => 'Validation errors',

            'data'      => $validator->errors()

        ],400));
    }

}