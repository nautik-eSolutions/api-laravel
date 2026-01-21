<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
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
        $data = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'identification_document' => ['required'],
            'birth_date' => ['required', 'date'],
            'identification_document_type'=>['required',Rule::in('DNI','NIE','Passaporte')]
        ]);

        $user = Person::create($data);

        return response()->json($user,201);

    }

    public function show(String $id)
    {
        $person = Person::find($id);

        if (!$person) {
            $data = [
                'message' => "Person not found",
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($person, 200);
    }

    public function update(Request $request, String $id)
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'identification_document' => ['required'],
            'birth_date' => ['required', 'date'],
            'identification_document_type'=>['required',Rule::in('DNI','NIE','Passaporte')]
        ]);
        $person = Person::find($id);

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

    public function destroy(String $id)
    {
        $person = Person::find($id);

        $person->delete();
        $data = [
            'message'=>"User has been deleted"
        ];
        return response()->json($data,204);
    }
}
