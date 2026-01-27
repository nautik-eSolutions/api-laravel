<?php

namespace App\Repositories\persons;

use App\Interfaces\persons\PersonInterface;
use App\Models\persons\Person;
use App\Models\users\User;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class PersonRepository implements PersonInterface
{

    public function show($id){
       return  Person::find($id);
    }
    public function showCaptainsByUser(User $user)
    {

        return $user->persons()->where('is_captain','=',true)->get();

    }

    public function showOwnersByUser(User $user)
    {
        $user->persons()->where('is_owner','=',true)->get();
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
        $person->saveOrFail();

        $query = DB::table('user_person')
            ->where('person_id','=',$person->id)
            ->where('user_id','=',$user->id)
            ->delete();

        return $query;
    }

    public function destroyOwner(Person $person, User $user)
    {
        $person->saveOrFail();

        $query = DB::table('user_person')
            ->where('person_id','=',$person->id)
            ->where('user_id','=',$user->id)
        ->delete();

        return $query;
    }



}