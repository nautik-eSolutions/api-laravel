<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Models\BoatType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function Pest\Laravel\json;

class BoatController extends Controller
{

    public function index(string $userId)
    {
        $boats = User::find($userId)->boats;

        if (!$boats) {
            $data = [
                'message' => "No boats were found",
                'status' => 404
            ];

            return response()->json($data, 404);

        }

        $data = [
            'boats' => $boats,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,string $userId)
    {
        $user =  User::find($userId);

        if (!$user){
            $data = [
                'message'=>'User not found',
                'status'=>404
            ];
            return response()->json($data,404);
        }


        $validator = Validator::make($request->all(), [
            "name"=>'required',
            "registry_number"=>'required',
            "length"=>'required',
            "beam"=>'required',
            "draft"=>'required',
            "boat_type"=>['required',Rule::in("motor","vela")]
        ]);

        if ($validator->fails()){
            $data = [
                'message'=>'Error in data validation',
                'errors'=>$validator->errors(),
                'status'=>400
            ];
            return response()->json($data,400);
        }
        $boat_type = BoatType::where('name',$request->boat_type)->get()->get(0);
        $boat = new Boat($request->request->all());

        $boat->boatType()->associate($boat_type);


        $savedBoat = $user->boats()->save($boat);


        return response()->json($savedBoat,201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $userName,string $boatName)
    {
        $user = User::where('user_name',$userName)->first();

        $boat = DB::table('boat')
            ->where('user_id',$user->id)
            ->where('name',$boatName)->first();

        if (!$boat){
            $data = [
              'message'=>'No boat was found'
            ];

            return response()->json($data);
        }


        return response()->json($boat,200);



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Boat $boat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boat $boat)
    {
        //
    }
}
