<?php

namespace App\Http\Controllers\boats;

use App\Http\Controllers\Controller;
use App\Models\boats\Boat;
use App\Models\boats\BoatType;
use App\Models\users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BoatController extends Controller
{

    public function index(string $userName)
    {
        $boats = User::where('user_name', $userName)->first()->boats;

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


    public function store(Request $request, string $userName)
    {
        $user = User::where('user_name', $userName)->first();

        if (!$user) {
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }


        $validator = Validator::make($request->all(), [
            "name" => 'required',
            "registry_number" => 'required',
            "length" => 'required',
            "beam" => 'required',
            "draft" => 'required',
            "boat_type" => ['required', Rule::in("motor", "vela")]
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error in data validation',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $boat_type = BoatType::where('name', $request->boat_type)->get()->get(0);
        $boat = new Boat($request->request->all());

        $boat->boatType()->associate($boat_type);


        $savedBoat = $user->boats()->save($boat);



        return response()->json($boat, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $userName, string $boatName)
    {
        $user = User::where('user_name', $userName)->first();

        if (!$user) {
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }


        $boat = DB::table('boat')
            ->where('user_id', $user->id)
            ->where('name', $boatName)->first();

        if (!$boat) {
            $data = [
                'message' => 'No boat was found',
                'status' => 404
            ];

            return response()->json($data, 404);
        }


        return response()->json($boat, 200);

    }


    public function update(Request $request, string $userName, string $boatName)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'string',
            "registry_number" => 'string',
            "length" => 'int',
            "beam" => 'int',
            "draft" => 'int',
            "boat_type" => [Rule::in("motor", "vela")]
        ]);

        $user = User::where('user_name', $userName)->first();


        if (!$user) {
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $rawBoat = DB::table('boat')
            ->where('user_id', $user->id)
            ->where('name', $boatName)->get();


        $boat = Boat::hydrate($rawBoat->all())->first();

        $boatUpdated = $boat->update($request->request->all());


        if (!$boatUpdated) {
            $data = [
                'message' => 'Was an error while updating your boat',
                'status' => 400
            ];
            return response()->json($data, 400);

        }
        $data = [
            'boat' => $boatUpdated,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function destroy(string $userName, string $boatName)
    {

        $user =  User::where('user_name',$userName)->first();

        $rawBoat = DB::table('boat')
            ->where('user_id', $user->id)
            ->where('name', $boatName)->get();


        $boat = Boat::hydrate($rawBoat->all())->first();
        $boat->delete();


        return redirect("/api/boats/$userName",302);




    }
}
