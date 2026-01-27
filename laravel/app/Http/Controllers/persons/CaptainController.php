<?php

namespace App\Http\Controllers\persons;

use App\Http\Controllers\Controller;
use App\Models\persons\Captain;
use App\Models\persons\Person;
use App\Services\persons\PersonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CaptainController extends Controller
{

    private PersonService $personService;

    public function __construct()
    {
        $this->personService = new PersonService();

    }

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
        $data = [
            'captain'=>$captain,
            'status'=>201
        ];

        return response()->json($data,201);

    }

    public function show(String $captainId)
    {

        $captain = Captain::find($captainId);

        if (!$captain){
            $data = [
                'message'=>'No captain was found',
                'status'=>404
            ];
            return response()->json($data,404);
        }

        $data = [
            'captain'=>$captain,
            'status'=>200
        ];

        return response()->json($data,200);

    }

    public function update(Request $request, $captainId)
    {
        $validator = Validator::make($request->all(), [
            "navigationLicense"=>'required'
        ]);

        if ($validator->fails()){
            $data = [
                'message'=>'Error in data validation',
                'errors'=>$validator->errors(),
                'status'=>400
            ];
            return response()->json($data,400);
        }

        $captain = Captain::find($captainId);
        $captain->navigationLicense = $request->navigationLicense;
        $data = [
            'message'=>$captain->save(),
            'status'=>200
        ];

        return response()->json($data,200);

    }


    public function destroy($captainId)
    {
        $captain = Captain::find($captainId);
        if (!$captain){
            $data = [
                'message'=>'No captain was found',
                'status'=>404
            ];
            return response()->json($data,404);
        }

        $captain->delete();
        $data = [
            'message'=>"User has been deleted"
        ];
        return response()->json($data,204);
    }
}
