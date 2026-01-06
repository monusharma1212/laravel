<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showData()
    {
        $user = DB::table('students')->get();

        return view('allusers', ['data' => $user]);
    }

    public function singleUser(string $id)
    {
        $user = DB::table('students')
            ->where('id', $id)
            ->get();
        return view('singleuser', ['data' => $user]);
    }

    public function addUser()
    {
        $affected = DB::table('students')->insertGetId(
            [
                'name' => 'sonu Kumar sharma',
                'email' => 'new@gmail.com',
                'age' => 20,
                'city' => 'Upsert Nothing chwjhjkfh check'
            ]
        );
        return $affected;   
    }

    // update 

    public function updateUser(){
        $user = DB::table('students')->where("id",5)
        ->increment('age');
        if($user){
            echo "Update successfully";
        } else{
            echo  "Update Not successfully";
        }
    }
}
