<?php

namespace App\Repositories\users;

use App\Interfaces\users\UserInterface;
use App\Models\users\User;

class UserRepository implements UserInterface
{


    public function show($id)
    {
        return User::find($id);
    }

    public function store(User $user)
    {
        return $user->saveOrFail();

    }

    public function update( $params,$id)
    {
        $user =  $this->show($id);

        return $user->updateOrFail($params);

    }

    public function delete($id)
    {
        $user = $this->show($id);

        return $user->deleteOrFail();

    }
}