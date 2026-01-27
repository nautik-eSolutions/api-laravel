<?php

namespace App\Repositories\persons;

use App\Interfaces\persons\PersonInterface;
use App\Models\persons\Person;

class PersonRepository implements PersonInterface
{

    public function store(Person $person) : bool
    {
       return  $person->saveOrFail();

    }

    public function update($params, $id): bool
    {
        $person = $this->show($id);

        return $person->updateOrFail($params);
    }

    public function show($id):Person
    {
        return Person::find($id);
    }

    public function delete($id): bool
    {
        $person = $this->show($id);

        return $person->deleteOrFail();


    }
}