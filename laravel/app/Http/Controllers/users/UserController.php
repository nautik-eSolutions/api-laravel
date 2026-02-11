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

    public function store(UserPostRequest $request){
        $user = $this->userService->store($request);
        return response()->json($user, 201);
    }


    public function show()
    {
        $user = auth('sanctum')->user();

        return response()->json($user, 200);
    }


    public function update(UserPatchRequest $request)
    {
        $user = auth('sanctum')->user();

        $data = $this->userService->update($request,$user);

        return response()->json($data,200);
    }



    public function destroy()
    {
        $user = auth('sanctum')->user();

        $data = $this->userService->delete($user);

        return response()->json($data,204);

    }
}
