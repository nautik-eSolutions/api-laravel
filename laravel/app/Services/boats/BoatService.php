<?php

namespace App\Services\boats;

use App\Http\Requests\persons\PersonPostRequest;
use App\Repositories\boats\BoatRepository;
use App\Repositories\persons\PersonRepository;
use App\Repositories\users\UserRepository;

class BoatService
{
    private $boatRepository;
    private $personRepository;
    private $userRepository;
    public function __construct()
    {
        $this->boatRepository = new BoatRepository();
        $this->personRepository =  new PersonRepository();
        $this->userRepository =  new UserRepository();
    }

    public function showBoatsByOwner($ownerId){
        $owner = $this->personRepository->show($ownerId);

        $boats = $this->boatRepository->showBoatsByOwner($owner);

        return $boats;

    }

}