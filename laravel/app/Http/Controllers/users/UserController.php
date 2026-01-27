<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\users\UserPatchRequest;
use App\Http\Requests\users\UserPostRequest;
use App\Models\users\User;
use App\Services\users\UserService;

class UserController extends Controller
{

    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }


    public function store(UserPostRequest $request){

        $user = $this->userService->store($request);
        return response()->json($user, 201);
    }


    public function show(int $id)
    {
        $user = $this->userService->show($id);

        return response()->json($user, 200);
    }


    public function update(UserPatchRequest $request, int $id)
    {
        $data = $this->userService->update($request,$id);

        return response()->json($data,200);
    }



    public function destroy(int $id)
    {
        $data = $this->userService->delete($id);

        return response()->json($data,$data['status']);

    }
}
