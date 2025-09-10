<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCprofileRequest;
use App\Models\CProfile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    

    public function StoreCustomerProfile(StoreCprofileRequest $request)
    {   
        try{
                $user_id=Auth::user()->id;
                $validatedData=$request->validated();
                $validatedData['user_id']=$user_id;
                
                if($request->hasFile('image'))
                {
                    $path=$request->file('image')->store('Profile-photos','public');
                    $validatedData['image']=$path;
                }

               $profile= CProfile::create($validatedData);

               return response()->json([
                "message"=>"profile created succesfully",
                "profile"=>$profile,
               ]);
        }
    
        catch(Exception $e){
            return  response()->json([
                "message"=>'some thing went wrong while creating profile',
                "details"=>$e->getMessage(),
            ]);
        }

    }






}
