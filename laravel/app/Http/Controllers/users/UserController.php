<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPostRequest;
use App\Models\users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }


    public function store(UserPostRequest $request){


        $user = User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'user_name' => $request->userName,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json($user, 201);
    }


    public function show(string $userName)
    {
        $user = User::where('user_name', $userName)->get();
        if (!$user) {
            $data = [
                'message' => "User not found",
                'status' => 404
            ];

            return response()->json($data, 404);

        }
        return response()->json($user, 200);
    }


    public function update(Request $request, string $userName)
    {
        $user = User::where('user_name', $userName)->get();
        if (!$user) {
            $data = [
                'message' => "User not found",
                'status' => 404
            ];

            return response()->json($data, 404);

        }
        $validator = Validator::make($request->all(), [
            "firstName"=>'required',
            "lastName"=>'required',
            "userName"=>'required',
            "email"=>'required|email',
            "password"=>'required'
        ]);

        if ($validator->fails()){
            $data = [
                'message'=>'Error in data validation',
                'errors'=>$validator->errors(),
                'status'=>400
            ];
            return response()->json($data,400);
        }
        $user->first_name =  $request->firstname;
        $user->last_name = $request->lastName;
        $user->user_name = $request->userName;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();
        ;

        $data = [
            'user'=>$user,
            'status'=>200
        ];

        return response()->json($data,200);
    }



    public function destroy(string $userName)
    {
        $user = User::where('user_name', $userName)->get();

        $user->delete();
        $data = [
            'message'=>"User has been deleted"
        ];
        return response()->json($data,204);

    }
}
