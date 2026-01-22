<?php

namespace App\Http\Controllers;

use App\Models\Captain;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use PHPUnit\Metadata\Parser\CachingParser;

class CaptainController extends Controller
{

    public function index()
    {
        $captains =  Captain::all();
        if (!$captains){
            $data = [
                'message' => "No captains where found",
                'status' => 404
            ];

            return response()->json($data, 404);
        }

    }

    public function store(Request $request, String $personId)
    {
        $person = Person::find($personId);
        $capt = new Captain();
        $capt->navigation_license=$request->navigationLicense;

        $captain =  $person->captain()->save($capt);

        $data = [
            'captain'=>$captain,
            'status'=>201
        ];

        return response()->json($data,201);

    }

    public function show(Request $request)
    {

    }


    public function update(Request $request, Captain $captain)
    {

    }


    public function destroy(Captain $captain)
    {

    }
}
