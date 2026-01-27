<?php

namespace App\Http\Requests\boats;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class BoatPostRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "name" => 'required|max:20',
            "registry_number" => 'required|max:10',
            "length" => 'required|max:3|min:0',
            "beam" => 'required|max:3|min:1',
            "draft" => 'required|max:3|min:1',
            "boat_type" => ['required', Rule::in("motor", "vela")]
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