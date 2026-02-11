<?php

namespace App\Http\Controllers\boats;

use App\Http\Controllers\Controller;
use App\Http\Requests\boats\BoatPatchRequest;
use App\Http\Requests\boats\BoatPostRequest;
use App\Services\boats\BoatService;
use Illuminate\Support\Facades\Auth;

class BoatController extends Controller
{

    private $boatService;

    public function __construct()
    {
        $this->boatService = new BoatService();
    }

    public function index(){

        $user = auth('sanctum')->user();

        $boats = $user->boats();

        return response()->json($boats,200);
    }




    public function store(BoatPostRequest $request)
    {
        $params = $request->request->all();

        $user = auth('sanctum')->user();

        $boat = $this->boatService->store($params,$user);

        return response()->json($boat, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = auth('sanctum')->user();

        $boat = $this->boatService->show($id,$user);

        return response()->json($boat, 200);

    }


    public function update(BoatPatchRequest $request,$id)
    {
        $params = $request->request->all();

        $user =  auth('sanctum')->user();

        $boat = $this->boatService->update($params,$user,$id);

        return response()->json($boat, 200);

    }

    public function destroy(int $boatId)
    {
        $user = auth('sanctum')->user();

        $this->boatService->destroy($boatId, $user);

        $message = 'Boat was deleted';
        return response()->json($message,204);
    }
}
