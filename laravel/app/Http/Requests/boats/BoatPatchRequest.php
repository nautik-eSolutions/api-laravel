<?php

namespace App\Http\Requests\persons;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class BoatPatchRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "name" => 'max:20',
            "registry_number" => 'max:10',
            "length" => 'max:3|min:0',
            "beam" => 'max:3|min:1',
            "draft" => 'max:3|min:1',
            "boat_type" => [Rule::in("motor", "vela")]
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