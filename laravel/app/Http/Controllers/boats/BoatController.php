<?php

namespace App\Http\Controllers\boats;

use App\Http\Controllers\Controller;
use App\Http\Requests\boats\BoatPatchRequest;
use App\Http\Requests\boats\BoatPostRequest;
use App\Services\boats\BoatService;

class BoatController extends Controller
{

    private $boatService;

    public function __construct()
    {
        $this->boatService = new BoatService();
    }

    public function indexByOwner($ownerId){

        $boats = $this->boatService->showBoatsByOwner($ownerId);

        return response()->json($boats,200);
    }
    public function indexByUser($userId){

        $boats = $this->boatService->showBoatsByUser($userId);

        return response()->json($boats,200);
    }


    public function store(BoatPostRequest $request, int $ownerId)
    {
        $params = $request->request->all();

        $boat = $this->boatService->store($params,$ownerId);

        return response()->json($boat, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $boat = $this->boatService->show($id);

        return response()->json($boat, 200);

    }


    public function update(BoatPatchRequest $request,$id)
    {
        $params = $request->request->all();

        $boat = $this->boatService->update($params,$id);

        return response()->json($boat, 200);

    }

    public function destroy(int $boatId)
    {

        $this->boatService->destroy($boatId);

        $message = 'Boat was deleted';
        return response()->json($message,204);
    }
}
