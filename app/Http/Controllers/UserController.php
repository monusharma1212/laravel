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

    public function addUser(Request $req)
    {
        $affected = DB::table('students')->insertGetId(
            [
                'fname' => $req->fname,
                'lname' => $req->lname,
                'age' => $req->age,
                'gender' => $req->gender,
                'phone' => $req->phone,
                'email' => $req->email,
                'address' => $req->address
            ]
        );
        if($affected){
        return redirect()->route('home')->with('success','User added successfully');
        } else{
            echo "data not inserted";
        }
    }

    // update

    public function userUpdate(string $id){

    }

    public function updateUser(){
        $user = DB::table('students')->where("id",5)
        ->increment('age');
        if($user){
            echo "Update successfully";
        } else{
            echo  "Update Not successfully";
        }
    }

    // delete

    public function userDelete($id){
        $user = DB::table('students')->where('id',$id)->delete();
        if($user){
            echo "Delete successFully";
        } else{
            echo "Delete not successFully";
        }
    }
}
