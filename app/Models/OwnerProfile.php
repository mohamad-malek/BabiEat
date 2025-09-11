<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerProfile extends Model
{
    protected $guarded=[];
    protected $table='restaurant_owner_profiles';


    public function user(){
        return $this->belongsTo(User::class);
    }
}
