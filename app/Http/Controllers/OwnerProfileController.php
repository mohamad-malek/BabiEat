<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOProfileRequest;
use App\Http\Requests\UpdateOProfileRequest;
use App\Models\OwnerProfile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Auth as SupportFacadesAuth;
use Illuminate\Support\Facades\Auth as IlluminateSupportFacadesAuth;

class OwnerProfileController extends Controller
{
    public function StoreOwnerProfile(StoreOProfileRequest $request)
    {   
        try{

           $user_id =Auth::user()->id;
           $validatedData=$request->validated();
           $validatedData['user_id']=$user_id;
           if($request->hasFile('image')){
               $path= $request->file('image')->store('profile-photos','public');
                $validatedData['image']=$path;   
         }    

            $profile=OwnerProfile::create($validatedData);
              return response()->json([
                    "message"=>"Profile created succesfully",
                    "profile"=>$profile
                   ],201);

        }
        catch(Exception $e)
        {   
           return response()->json([
                    "message"=>"something went wrong",
                    "details"=>$e->getMessage(),
                ]); 
        }
    }


    public function UpdateOwnerProfile(UpdateOProfileRequest $request,$profileId)
    {
        $user_id=Auth::user()->id;
        $profile=OwnerProfile::findOrFail($profileId);
        if($profile->user_id!=$user_id){
            return response()->json('unauthrized',403);
        }else{
            $validatedData=$request->validated();
            $profile->update($request->validated());
            return response()->json([
                "message"=>"Profile updated succesfully",
                "profile"=>$profile,
            ]);
        }
    }
}

