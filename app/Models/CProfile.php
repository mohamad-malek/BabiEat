<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CProfile extends Model
{   
    protected $guarded=[];
    protected $table ='customer_profiles';
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}

