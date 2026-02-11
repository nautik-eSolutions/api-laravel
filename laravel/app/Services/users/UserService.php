<?php

namespace App\Services\users;

use App\Http\Requests\users\UserPatchRequest;
use App\Http\Requests\users\UserPostRequest;
use App\Models\users\User;
use App\Repositories\users\UserRepository;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserService
{



    public function __construct()
    {
    }


    public function store(UserPostRequest $request) : User
    {
        $params = $request->request->all();

        $params['password'] = Hash::make($params['password']);

        return User::create($params);
    }

    public function update(UserPatchRequest $request, $user): bool
    {
        $params = $request->request->all();

        return $user->updateOrFail($params);
    }

    public function delete($user) : bool
    {
        return $user->deleteOrFail();
    }




}