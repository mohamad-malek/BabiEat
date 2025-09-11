<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverProfile extends Model
{
    protected $guarded=[];
    protected $table='driver_profiles';


    public function user(){
        return $this->belongsTo(User::class);
    }

}
