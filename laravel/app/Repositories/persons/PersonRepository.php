<?php

namespace App\Repositories\persons;

use App\Interfaces\persons\PersonInterface;
use App\Models\persons\Person;
use App\Models\users\User;
class PersonRepository implements PersonInterface
{

    public function show($id){
       return  Person::find($id);
    }
    public function showCaptainsByUser(User $user)
    {
        return $user->persons()->where('is_captain','=',true);
    }

    public function showOwnersByUser(User $user)
    {
        return $user->persons()->where('is_owner','=',true);
    }

    public function storeCaptain(Person $person,User $user)
    {
        return $user->persons()->save($person);
    }


    public function storeOwner(Person $person, User $user)
    {
        return $user->persons()->save($person);
    }

    public function updateCaptain(Person $person)
    {
        return $person->update();
    }

    public function destroyCaptain(Person $person, User $user)
    {
        return $user->persons()->delete($person);
    }

    public function destroyOwner(Person $person, User $user)
    {
        return $user->persons()->delete($person);
    }



}