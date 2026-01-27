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
        return $this->personRepository->show($id);
    }

    public function storeCaptain($params, $userId):Person
    {
        $person = new Person($params);

        $this->userService->show($userId)->save($person);

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