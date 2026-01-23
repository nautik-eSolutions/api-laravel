<?php

namespace App\Http\Controllers\persons;

use App\Http\Controllers\Controller;
use App\Models\persons\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PersonController extends Controller
{
    public function index()
    {
        $persons = Person::all();

        $data = [
            'users'=>$persons,
            'status'=>200
        ];

        return response()->json($data,200);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'firstName' => ['required'],
            'lastname' => ['required'],
            'identificationDocument' => ['required'],
            'birthDate' => ['required', 'date'],
            'identificationDocumentType'=>['required',Rule::in('DNI','NIE','Passaporte')]
        ]);
        if ($validator->fails()){
            $data = [
                'message'=>'Error in data validation',
                'errors'=>$validator->errors(),
                'status'=>400
            ];
            return response()->json($data,400);
        }
        $user = Person::create([
            'first_name' => $request->firsName,
            'last_name' => $request->lastName,
            'identification_document' => $request->identificationDocument,
            'birth_date' => $request->birthDate,
            'identification_document_type'=>$request->identifactionDocumentType
        ]);

        return response()->json($user,201);

    }

    public function show(String $personId)
    {
        $person = Person::find($personId);

        if (!$person) {
            $data = [
                'message' => "Person not found",
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($person, 200);
    }

    public function update(Request $request, String $personId)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => ['required'],
            'last_name' => ['required'],
            'identification_document' => ['required'],
            'birth_date' => ['required', 'date'],
            'identification_document_type'=>['required',Rule::in('DNI','NIE','Passaporte')]
        ]);

        if ($validator->fails()){
            $data = [
                'message'=>'Error in data validation',
                'errors'=>$validator->errors(),
                'status'=>400
            ];
            return response()->json($data,400);
        }

        $person = Person::find($personId);

        $person->first_name =  $request->firstName;
        $person->last_name = $request->lastName;
        $person->identification_document = $request->identificationDocument;
        $person->birth_date = $request->birthDate;
        $person->identification_document_type = $request->identificationDocumentType;

        $person->update($person);

        $data = [
            'person'=>$person,
            'status'=>200
        ];

        return response()->json($data,200);
    }

    public function destroy(String $personId)
    {
        $person = Person::find($personId);

        if (!$person) {
            $data = [
                'message' => "Person not found",
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $person->delete();
        $data = [
            'message'=>"User has been deleted"
        ];
        return response()->json($data,204);
    }
}
