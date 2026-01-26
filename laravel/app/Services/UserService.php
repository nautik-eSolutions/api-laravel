<?php

namespace App\Services;

use App\Http\Requests\UserPatchRequest;
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
        $params = $request->request->all();

        $params['password'] = bcrypt($params['password']);

        return new User($params);

    }

    public function update(UserPatchRequest $request, $id){
        $params = $request->request->all();

         $user = $this->repository->update($params, $id);

         return $this->responseMessage('user',$user,200);

    }

    public function delete($id){
        if ($this->repository->delete($id)){
            return $this->responseMessage('message','User was deleted',204);
        }else{
            return $this->responseMessage('error','Something went wrong',500);
        }
    }

    private function responseMessage($name,$object,int $status = 200){
        return [
            $name=>$object,
            'status'=>$status
        ];
    }

}