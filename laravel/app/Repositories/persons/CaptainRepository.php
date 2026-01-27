<?php

namespace App\Repositories\persons;


use App\Interfaces\persons\CaptainInterface;
use App\Models\persons\Captain;
use App\Models\persons\Person;
use App\Models\users\User;

class CaptainRepository implements CaptainInterface
{

    public function indexByUser($userId)
    {
        // TODO: Implement indexByUser() method.
    }

    public function show($id)
    {
        return Captain::find($id);
    }

    public function store( Captain $captain,Person $person , User $user)
    {
        $savedCaptain = $person->captain()->save($captain);

        return $user->captains()->save($savedCaptain);
    }

    public function update($params, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}