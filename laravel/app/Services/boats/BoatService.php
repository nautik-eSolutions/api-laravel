<?php

namespace App\Services\boats;

use App\Http\Requests\persons\BoatPostRequest;
use App\Models\persons\Person;
use App\Models\users\User;
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
        $owner = Person::find($ownerId);
        return $owner->boats();

    }
    public function showBoatsByUser($userId){
        $user = User::find($userId);

        $boats = $this->boatRepository->showBoatsByUser($user);

        return $boats;

    }

}