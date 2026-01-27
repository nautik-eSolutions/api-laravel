<?php

namespace App\Http\Requests\persons;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PersonPostRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "firstName"=>'required|max:20|min:2',
            "lastName"=>'required|max:20|min:2',
            "identificationDocument"=>'required|max:20|min:2',
            "birthDate"=>'required|date',
            "identificationDocumentType"=>['required',Rule::in('DNI','NIE','Passaporte')]
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