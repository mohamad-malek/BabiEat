<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDProfileRequest;
use App\Http\Requests\UpdateDProfileRequest;
use App\Models\DriverProfile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverProfileController extends Controller
{


        public function StoreDriverProfile(StoreDProfileRequest $request)
        {
            try{
                   $user_id=Auth::user()->id;
                $validatedData=$request->validated();
                $validatedData['user_id']=$user_id;

                if($request->hasFile('image'))
                {
                    $path=$request->file('image')->store('profile-photos','public');
                    $validatedData['image']=$path;
                }
                $profile=DriverProfile::create($validatedData);
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



        public function UpdateDriverProfile(UpdateDProfileRequest $request,$profileId)
        {   
            $user_id=Auth::user()->id;
            $profile=DriverProfile::findOrFail($profileId);
            if($profile->user_id!=$user_id){
                return response()->json('unauthorized');
            }else{
                $profile->update($request->validated());
                return response()->json([
                    'messsage'=>"Profile updated succesfully",
                    'profile'=>$profile,   
                ],200);
            }
        }   


}
