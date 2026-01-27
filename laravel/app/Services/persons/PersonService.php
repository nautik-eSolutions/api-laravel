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

    public function store($params, $userId):Person
    {
        $user = $this->userService->show($userId);

        $person = new Person($params);



    }

    public function update($params, $id)
    {

    }

    public function delete($id)
    {

    }

    private function responseMessage($name, $object, int $status = 200)
    {
        return [
            $name => $object,
            'status' => $status
        ];
    }

}