<?php

namespace App\Services\persons;

use App\Models\persons\Person;
use App\Repositories\persons\PersonRepository;
use App\Services\users\UserService;

class PersonService
{

    private $personRepository;
    private $userService;

    public function __construct()
    {
        $this->personRepository = new PersonRepository();
        $this->userService = new UserService();
    }


    public function show($id): Person
    {
        $person = $this->personRepository->show($id);


        return $person;
    }

    public function store($params, $userId): false | Person
    {
        $person =  new Person($params);

        return $this->userService->saveEntity($person,$userId) ? $person : false;
    }

    public function update($params, $id)
    {
        return $this->personRepository->update($params,$id);
    }

    public function delete($id)
    {
        return $this->personRepository->delete($id);
    }

    private function responseMessage($name, $object, int $status = 200)
    {
        return [
            $name => $object,
            'status' => $status
        ];
    }

}