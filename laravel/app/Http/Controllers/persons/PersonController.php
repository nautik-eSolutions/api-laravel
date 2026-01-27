<?php

namespace App\Http\Controllers\persons;

use App\Http\Controllers\Controller;
use App\Http\Requests\persons\PersonPostRequest;
use App\Models\persons\Person;
use App\Services\persons\PersonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PersonController extends Controller
{
    private $personService;

    public function __construct()
    {
        $this->personService = new PersonService();
    }

    public function index()
    {
        $persons = Person::all();

        $data = [
            'users' => $persons,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function store(PersonPostRequest $request, $userId)
    {
        $person = $this->personService->store($request, $userId);

        return response()->json($person, 201);

    }

    public function show(string $personId)
    {
        $person = $this->personService->show($personId);

        return response()->json($person, 200);
    }

    public function update(Request $request, string $personId)
    {
        $person = $this->update($request,$personId);

        $data = [
            'person' => $person,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy(string $personId)
    {
        $resp = $this->personService->delete($personId);

        if ($resp) {
            $data = [
                'message' => "User has been deleted"
            ];
            return response()->json($data, 204);
        }
        return response()->json('something went wrong', 400);

    }
}
