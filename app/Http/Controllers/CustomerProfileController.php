<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCprofileRequest;
use App\Http\Requests\UpdateCProfileRequest;
use App\Models\CProfile;
use Exception;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerProfileController extends Controller
{


    public function StoreCustomerProfile(StoreCprofileRequest $request)
    {   
            try{
                    $user_id = Auth::user()->id;
                    $validatedData=$request->validated();
                    $validatedData['user_id']=$user_id;

                    if($request->hasFile('image')){
                        $path=$request->file('image')->store('profile-photos','public');
                        $validatedData['image']=$path;
                    }
                   $profile= CProfile::create($validatedData);
                   return response()->json([
                    "message"=>"Profile created succesfully",
                    "profile"=>$profile
                   ],201);

            }
            catch(Exception $e){
                return response()->json([
                    "message"=>"something went wrong",
                    "details"=>$e->getMessage(),
                ]);
            }   
        
    }

    
    public function UpdateCustomerProfile(UpdateCProfileRequest $request,$profile_Id)
    {   
           $user_id= Auth::user()->id;
           $profile=CProfile::findOrFail($profile_Id);
           if($profile->user_id!=$user_id){
            return response()->json('unauthorized',403);
           }else{
            $profile->update($request->validated());
            return response()->json([
                    "message"=>"profile updated succesfully",
                    "profile"=>$profile,
                ],200);
           }

    }   
}



