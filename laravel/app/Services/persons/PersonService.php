<?php

namespace App\Services\persons;



use App\Models\persons\Person;
use App\Models\users\User;
use App\Repositories\persons\PersonRepository;
use App\Repositories\users\UserRepository;
use Illuminate\Support\Facades\DB;


class PersonService
{


    public function __construct()
    {

    }


    public function show($id): Person
    {
        return Person::find($id);
    }

    public function showCaptainsByUser($userId)
    {
       $user =  User::find($userId);

        return $user->where('is_captain','=',true)->get();
    }

    public function showOwnersByUser($userId)
    {
        $user = User::find($userId);

        return $user->where('is_owner','=',true)->get();

    }

    public function storeCaptain($params, $userId)
    {
        $params['is_captain'] = true;

        $user = User::find($userId);

        $person = new Person($params);

        return $user->persons()->save($person);
    }

    public function updateCaptain($params, $captainId)
    {
        $captain = Person::find($captainId);

        return $captain->update($params);

    }

    public function destroyCaptain($captainId, $userId)
    {
        $captain = Person::find($captainId);
        $user = User::find($userId);

        $captain->is_captain = false;
        $captain->save();

        return DB::table('user_person')
            ->where('person_id','=',$captain->id)
            ->where('user_id','=',$user->id)
            ->delete();

    }

    public function storeOwner($params, $userId)
    {
        $params['is_owner'] = true;

        $user = User::find($userId);

        $person = new Person($params);

        return $user->persons()->save($person);
    }

    public function destroyOwner($ownerId, $userId)
    {
        $owner = Person::find($ownerId);
        $user = User::find($userId);

        $owner->is_owner =false;
        $owner->save();


        return DB::table('user_person')
            ->where('person_id','=',$owner->id)
            ->where('user_id','=',$user->id)
            ->delete();


    }


}