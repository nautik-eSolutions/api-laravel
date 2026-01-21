<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        $user = User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'user_name' => $request->userName,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username)
    {
        $user = User::where('user_name', $username)->get();
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $username)
    {
        $user = User::where('user_name', $username)->get();
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
        $user->firstName =  $request->firstname;
        $user->lastName = $request->lastName;
        $user->userName = $request->userName;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();


        $data = [
            'user'=>$user,
            'status'=>200
        ];

        return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $username)
    {
        $user = User::where('user_name', $username)->get();

        $user->delete();

    }
}
