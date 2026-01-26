<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
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

    public function update(User $user)
    {
        return $user->saveOrFail();

    }

    public function delete($id)
    {
    }
}