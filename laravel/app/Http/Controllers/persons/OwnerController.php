<?php

namespace App\Http\Controllers\persons;

use App\Http\Controllers\Controller;
use App\Models\users\Owner;
use App\Models\users\Person;
use Illuminate\Http\Request;

class OwnerController extends Controller
{

    public function index()
    {
        $owners = Owner::all();
        $data = [
          'owners'=>$owners,
          'status'=>200
        ];
        return response()->json($data);
    }


    public function store(String $personId)
    {
     $person = Person::find($personId);

        if (!$person) {
            $data = [
                'message' => "Person not found",
                'status' => 400
            ];

            return response()->json($data, 404);

        }

     $owner = new Owner();

     $person->owner()->save($owner);

     $owner->push();
     $data = [
            'owner'=>$owner,
            'status'=>201
        ];
        return response()->json($data,201);
     ;
    }





    public function show(String $ownerId)
    {
        $owner = Owner::find($ownerId);

        if (!$owner){
            $data = [
                'message'=>"Owner not found",
                "status"=>404
            ];
            return response()->json($data,404);
        }
        $data = [
          'owner'=>$owner,
          'status'=>200
        ];

        return response()->json($data,200);


    }



    public function update(Request $request, Owner $owner)
    {
        //Falta decidir si hay que poner la documentación de propiedad en owner
    }


    public function destroy(String $ownerId)
    {
        $owner =  Owner::find($ownerId);

        if (!$owner){
            $data = [
                'message'=>'No captain was found',
                'status'=>404
            ];
            return response()->json($data,404);
        }

        $owner->delete();
        $data=[
          'message'=>'The owner has been deleted',
            'status'=>204
        ];

        return response()->json($data,204);



    }
}
