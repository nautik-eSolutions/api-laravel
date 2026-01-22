<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Person;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

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


    public function store(String $id)
    {
     $person = Person::find($id);

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





    public function show(String $id)
    {
        $owner = Owner::find($id);

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
        //
    }


    public function destroy(String $id)
    {
        $owner =  Owner::find($id);

        $owner->delete();
        $data=[
          'message'=>'The owner has been deleted'
        ];


    }
}
