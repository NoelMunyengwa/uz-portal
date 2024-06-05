<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;


class UserAuthController extends Controller
{
    //get all users
    public function users(Request $request){
        //check if auth user is admin
        $user = User::where('email',$request->email)->first();
        if($user->role == 'admin'){
            $users = User::all();
            return response()->json([
                'users' => $users
            ]);
        }else{
            return response()->json([
                'message' => 'Unauthorized'
            ]);
        }
    }
    public function register(Request $request){
        $registerUserData = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'role'=> 'required|string',
            'department'=>'string',
            'password'=>'required|min:8'
        ]);
        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'role' => $registerUserData['role'],
            'department' => $registerUserData['department'],
            'password' => Hash::make($registerUserData['password']),
        ]);
        return response()->json([
            'message' => 'User Created ',
        ]);
    }
    public function login(Request $request){
        $loginUserData = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|min:8'
        ]);
        $user = User::where('email',$loginUserData['email'])->first();
        if(!$user || !Hash::check($loginUserData['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        return response()->json([
            'user'=>$user->email,
            'role'=>$user->role,
            'access_token' => $token,
        ]);
    }

    //logout using email
    public function logout(Request $request){
       try{
        $user = User::where('email',$request->email)->first();
        $user->tokens()->delete();
        return response()->json([
            'message' => 'Logged Out'
        ]);
         }catch(\Exception $e){
              return response()->json([
                'message' => 'Something went wrong!'
              ]);
    }
}
}