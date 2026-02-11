<?php

namespace App\Http\Requests\persons;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PersonCaptainPostRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "first_name"=>'required|max:20|min:2',
            "last_name"=>'required|max:20|min:2',
            "identification_document"=>'required|max:20|min:2',
            "birth_date"=>'required|date',
            "identification_document_type"=>'required',[Rule::in('DNI','NIE','Passaporte')],
            "navigation_license"=>'required|min:2'
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