<?php

namespace App\Interfaces\persons;

use App\Models\persons\Person;

interface PersonInterface
{

    public function  store(Person $person);

    public function update($params, $id);

    public function show($id);

    public function delete($id);

    public function setCaptain(Person $person);
    public function setOwner(Person $person);
    public function updateCaptain(Person $person);
    public function unsetCaptain(Person $person);
    public function unsetOwner(Person $person);

}