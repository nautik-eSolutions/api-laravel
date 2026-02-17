<?php

namespace App\Http\Controllers\boats;

use App\Http\Controllers\Controller;
use App\Http\Requests\boats\BoatPatchRequest;
use App\Http\Requests\boats\BoatPostRequest;
use App\Services\boats\BoatService;
use App\Utils\Auth\JwtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoatController extends Controller
{

    private $boatService;

    public function __construct()
    {
        $this->boatService = new BoatService();
    }

    public function index(Request $request){

        $user = JwtService::getUser($request->bearerToken());

         //$user = auth('sanctum')->user();

        $boats = $user->boats()->get();





        return response()->json($boats,200);
    }




    public function store(BoatPostRequest $request)
    {

        $user = JwtService::getUser($request->bearerToken());


        $params = $request->request->all();

        //$user = auth('sanctum')->user();


        $boat = $this->boatService->store($params,$user);

        return response()->json($boat, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$id)
    {
        //$user = auth('sanctum')->user();

        $user = JwtService::getUser($request->bearerToken());

        $boat = $this->boatService->show($id,$user);

        return response()->json($boat, 200);

    }


    public function update(BoatPatchRequest $request,$id)
    {
        $params = $request->request->all();

        $user = JwtService::getUser($request->bearerToken());

        //$user =  auth('sanctum')->user();

        $boat = $this->boatService->update($params,$user,$id);
        if (!$boat){

        }
        return response()->json($boat, 200);

    }

    public function destroy(int $boatId, Request $request)
    {
        //$user = auth('sanctum')->user();
        $user = JwtService::getUser($request->bearerToken());

        $this->boatService->destroy($boatId, $user);

        $message = 'Boat was deleted';
        return response()->json($message,204);
    }
}
