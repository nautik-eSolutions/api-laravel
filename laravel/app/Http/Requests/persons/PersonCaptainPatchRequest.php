<?php

namespace App\Http\Requests\persons;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PersonCaptainPatchRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "navigation_license"=>'required'
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