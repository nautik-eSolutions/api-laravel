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





    public function show(Owner $owner)
    {
        //
    }


    public function edit(Owner $owner)
    {
        //
    }


    public function update(Request $request, Owner $owner)
    {
        //
    }


    public function destroy(Owner $owner)
    {
        //
    }
}
