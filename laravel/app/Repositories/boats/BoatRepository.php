<?php

namespace App\Repositories\boats;

use App\Interfaces\boats\BoatsInterface;
use App\Models\boats\Boat;
use App\Models\persons\Person;
use App\Models\users\User;
use DB;

class BoatRepository implements BoatsInterface
{

    public function showBoatsByOwner(Person $owner)
    {
        $result = DB::table('boat')
            ->where('person_id','=',$owner->id)->get();

        return $result;
    }

    public function showBoatsByUser(User $user)
    {
        $result = DB::table('boat')
            ->join('user_person','user_person.person_id','=','boat.person_id')
            ->join('user','user_id','=','user_person.user_id')
            ->get();

        return $result;
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store(Boat $boat)
    {
        // TODO: Implement store() method.
    }

    public function update(Boat $boat)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}