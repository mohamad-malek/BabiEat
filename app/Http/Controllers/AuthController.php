<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
            "message"=>"User registered succesfully",
            "User"=>$user,
        ],201);

    }

    // login function
    public function login()
    {

    }

    // logout function
    public function logout()
    {

    }

}


