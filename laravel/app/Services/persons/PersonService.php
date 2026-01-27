<?php

namespace App\Services\persons;

use App\Models\persons\Person;
use App\Repositories\persons\PersonRepository;
use App\Repositories\users\UserRepository;
use App\Services\users\UserService;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class PersonService
{

    private PersonRepository $personRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->personRepository = new PersonRepository();
        $this->userRepository = new UserRepository();
    }


    public function show($id): Person
    {
        return $this->personRepository->show($id);
    }

    public function storeCaptain($params, $userId)
    {
        $params['is_captain'] = true;

        $user = $this->userRepository->show($userId);

        $person = new Person($params);

        return $this->personRepository->storeCaptain($person, $user);
    }

    public function updateCaptain($params, $captainId)
    {
        $captain = $this->personRepository->show($captainId);

        $captain->navigation_license = $params['navigation_license'];

        return $this->personRepository->updateCaptain($captain);

    }

    public function destroyCaptain($captainId, $userId)
    {
        $captain = $this->personRepository->show($captainId);
        $user = $this->userRepository->show($userId);

        return $this->personRepository->destroyCaptain($captain,$user);

    }

    public function storeOwner($params, $userId){
        $params['is_owner'] = true;

        $user = $this->userRepository->show($userId);

        $person = new Person($params);

        return $this->personRepository->storeCaptain($person, $user);
    }

    public function destroyOwner($ownerId, $userId)
    {
        $owner = $this->personRepository->show($ownerId);
        $user = $this->userRepository->show($userId);

        return $this->personRepository->destroyOwner($owner,$user);

    }



}