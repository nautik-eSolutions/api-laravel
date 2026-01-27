<?php

namespace App\Services\users;

use App\Http\Requests\users\UserPatchRequest;
use App\Http\Requests\users\UserPostRequest;
use App\Models\users\User;
use App\Repositories\users\UserRepository;
use Throwable;

class UserService
{



    public function __construct()
    {
    }


    public function show($id) : User
    {
        return User::find($id);
    }


    public function store(UserPostRequest $request) : User
    {
        $params = $request->request->all();

        $params['password'] = bcrypt($params['password']);

        return User::create($params);
    }

    public function update(UserPatchRequest $request, $id): bool
    {
        $params = $request->request->all();

        $user = User::find($id);

        return $user->updateOrFail($params);
    }

    public function delete($id) : bool
    {
        $user = User::find($id);

        return $user->deleteOrFail();
    }




}