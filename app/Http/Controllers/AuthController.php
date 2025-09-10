<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\CssSelector\Node\FunctionNode;

class AuthController extends Controller
{

    // register function
    public function Register(Request $request)
    {
        $request->validate([
            "name"      =>   'required|string|max:255',
            "email"     =>   'required|email|unique:users,email',
            "password"  =>   'required|string|min:8|confirmed',
            "phone"     =>   'required|string|max:20|unique:users,phone',
            "role"      =>   'in:customer,restaurant_owner,admin,driver',
        ]);

        $user = User::create([
            'name'=>  $request->name,
            'email'=> $request->email,
            'password'=>Hash::make($request->password),
            'phone'=> $request->phone,
            'role'=> $request->role??'customer',
        ]);

        return response()->json([
            "message"  => "User registered succesfully",
            "User"=>$user,
        ],201);

    }

    // login function
    public function Login(Request $request)
    {
        $request->validate([    
            "email"     =>  'required|string|email',
            "password"  =>  'required|string',
        ]);
        
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json(["message"=>'invalid email or password'],401);
        }   
        $user = User::where('email',$request->email)->firstOrFail();
        $token= $user->createToken('auth_token')->plainTextToken;
        return response()->json([   
            "message" => "login succesfull",
            "user" => $user,
            "token" =>$token,
        ],200);
        
    }

    // logout function
    public function Logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(["message"=>"logout succesfull"],200);
    }

}




