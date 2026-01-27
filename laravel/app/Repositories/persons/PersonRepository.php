<?php

namespace App\Repositories\persons;

use App\Interfaces\persons\PersonInterface;
use App\Models\persons\Person;

class PersonRepository implements PersonInterface
{

    public function store(Person $person) : bool
    {
       return $person->saveOrFail();
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
    public function showByIdentificationDocument($identificationDocument){
        return Person::where('identification_document',$identificationDocument)->get();
    }


    public function setCaptain(Person $person)
    {
    }

    public function setOwner(Person $person)
    {
        // TODO: Implement setOwner() method.
    }

    public function updateCaptain(Person $person)
    {
        // TODO: Implement updateCaptain() method.
    }

    public function unsetCaptain(Person $person)
    {
        // TODO: Implement unsetCaptain() method.
    }

    public function unsetOwner(Person $person)
    {
        // TODO: Implement unsetOwner() method.
    }
}