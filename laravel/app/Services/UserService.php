<?php

namespace App\Services;

use App\Http\Requests\UserPostRequest;
use App\Models\users\User;
use App\Repositories\UserRepository;

class UserService
{

    private $repository;
    public function __construct()
    {
        $this->repository = new UserRepository();
    }


    public function show($id){
        return $this->repository->show($id);
    }
    public function store(UserPostRequest $request){
         $user = new User($request->request->all());
         return $user;

    }

    public function update(){

    }

    public function delete(){

    }

}