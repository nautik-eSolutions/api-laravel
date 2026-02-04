<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\users\UserLoginRequest;
use App\Http\Requests\users\UserPostRequest;
use App\Models\users\User;
use App\Services\users\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    private UserService $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function register(UserPostRequest $request){
        $this->userService->store($request);

        return response()->json([
            'message' => 'User Created ',
        ]);
    }

    public function login(UserLoginRequest $request){

        $user = User::where('email',$request['email'])->first();
        if(!$user || !Hash::check($request['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            "message"=>"logged out"
        ]);
    }

}
