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
        $result = DB::table('boats')
            ->where('person_id','=',$owner->id)->get();

        return $result;
    }

    public function showBoatsByUser(User $user)
    {
        // TODO: Implement showBoatsByUser() method.
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