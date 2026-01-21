<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        return Person::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'identification_document' => ['required'],
            'birth_date' => ['required', 'date'],
        ]);

        return Person::create($data);
    }

    public function show(Person $person)
    {
        return $person;
    }

    public function update(Request $request, Person $person)
    {
        $data = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'identification_document' => ['required'],
            'birth_date' => ['required', 'date'],
        ]);

        $person->update($data);

        return $person;
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return response()->json();
    }
}
