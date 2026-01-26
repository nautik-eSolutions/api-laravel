<?php

namespace App\Interfaces\persons;

use App\Models\persons\Person;

interface PersonInterface
{

    public function  store(Person $person);

    public function update($params, $id);

    public function show($id);

    public function delete($id);


}