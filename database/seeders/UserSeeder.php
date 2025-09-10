<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


         User::create([
    
             'name'=>  "mohamad malek",
            'email'=> "malek@gmail.com",
            'password'=>"12345678910",
            "phone"=>"81234806",
            'role'=> "admin"
            
            
        ]);   

    }
}
