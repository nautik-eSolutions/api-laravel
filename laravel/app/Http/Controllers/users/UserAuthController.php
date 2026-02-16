<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\users\UserLoginRequest;
use App\Http\Requests\users\UserPostRequest;
use App\Http\Resources\UserAuthResource;
use App\Models\users\User;
use App\Services\users\UserService;
use App\Utils\Auth\JwtService;
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
        $user = $this->userService->store($request);

        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        return $this->authenticatedResponse($user,$token);
    }

    public function login(UserLoginRequest $request){

        $user = User::where('email',$request['email'])->first();
        if(!$user || !Hash::check($request['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }

        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        
        return $this->authenticatedResponse($user,$token);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            "message"=>"logged out"
        ]);
    }


    public function OAuthLogin(Request $request){
        $token =  $request->token;
        return JwtService::decode($token);
    }



    private function authenticatedResponse($user, $token){
        $userResponse = [
          'userName' =>$user->user_name,
          'email'=>$user->email
        ];

        return [
            'user'=>$userResponse,
            'token'=>$token
        ];
    }


}
