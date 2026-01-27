<?php

namespace App\Http\Controllers\persons;

use App\Http\Controllers\Controller;
use App\Http\Requests\persons\PersonCaptainPatchRequest;
use App\Http\Requests\persons\PersonCaptainPostRequest;
use App\Http\Requests\persons\BoatPostRequest;
use App\Services\persons\PersonService;

class PersonController extends Controller
{

    private PersonService $personService;

    public function __construct()
    {
        $this->personService =  new PersonService();
    }

    public function index()
    {

    }

    public function show($id){
        $person = $this->personService->show($id);

        $message = $this->setMessage('person',$person);

        return $this->response($message,200);
    }

    public function showCaptainsByUser($userId){
        $captains = $this->personService->showCaptainsByUser($userId);

        $message = $this->setMessage('captains',$captains);

        return $this->response($message,200);
    }
    public function showOwnersByUser($userId){
        $owners = $this->personService->showCaptainsByUser($userId);

        $message = $this->setMessage('owners',$owners);

        return $this->response($message,200);
    }

    public function storeCaptain(PersonCaptainPostRequest $request, int $userId)
    {
        $params = $request->request->all();

        $captain =  $this->personService->storeCaptain($params,$userId);

        $message = $this->setMessage('captain',$captain);

        return $this->response($message,201);
    }
    public function storeOwner(BoatPostRequest $request, int $userId){
        $params = $request->request->all();

        $captain =  $this->personService->storeOwner($params,$userId);

        $message = $this->setMessage('owner',$captain);

        return $this->response($message,201);
    }

    public function updateCaptain(PersonCaptainPatchRequest $request, int $userId, $captainId)
    {
        $params= $request->request->all();

        $message = $this->personService->updateCaptain($params,$captainId);

        return $this->response($message,200);
    }

    public function destroyCaptain($userId, $captainId){
        $message = $this->personService->destroyCaptain($captainId,$userId);

        return $this->response($message,204);
    }

    public function destroyOwner($userId,$ownerId){
        $message =  $this->personService->destroyOwner($ownerId,$userId);

        return $this->response($message,204);

    }




    private function response($data, int $status)
    {
        return response()->json($data, $status);
    }

    private function setMessage(string $header,$data){
        return [
          $header=>$data
        ];
    }



}
