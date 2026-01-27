<?php

namespace App\Services\users;

use App\Http\Requests\users\UserPatchRequest;
use App\Http\Requests\users\UserPostRequest;
use App\Models\users\User;
use App\Repositories\users\UserRepository;
use Throwable;

class UserService
{

    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }


    public function show($id) : User
    {
        return $this->repository->show($id);
    }


    public function store(UserPostRequest $request) : User
    {
        $params = $request->request->all();

        $params['password'] = bcrypt($params['password']);
        $user = new User($params);
        $this->repository->store($user);
        return $user;
    }

    public function update(UserPatchRequest $request, $id): User
    {
        $params = $request->request->all();

        $user = $this->repository->update($params, $id);


        return $user;
    }

    public function delete($id) : array
    {
        if ($this->repository->delete($id)) {
            return $this->responseMessage('message', 'User was deleted', 204);
        } else {
            return $this->responseMessage('error', 'Something went wrong', 500);
        }
    }

    public function saveEntity($entity, $userId) : bool
    {
        $user = $this->show($userId);


        try {


        }catch (Throwable){

            return false;
        }

        return true;
    }



    private function responseMessage($name, $object, int $status = 200) :array
    {
        return [
            $name => $object,
            'status' => $status
        ];
    }

}