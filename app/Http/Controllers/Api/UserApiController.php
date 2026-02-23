<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{


    public function register(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
            'bio' => 'required|string',
            'newsletter' => 'required|boolean',
            'shift' => 'required|string',
            'skill_level' => 'required|string',
            'theme_color' => 'required|string',
            'department' => 'required|array',
            'experience' => 'required|integer',
            'dob' => 'required|date',
        ]);
        

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'dob' => $request->dob,
            'experience' => $request->experience,
            'department' => $request->department,
            'theme_color' => $request->theme_color,
            'skill_level' => $request->skill_level,
            'shift' => $request->shift,
            'newsletter' => $request->newsletter,
            'bio' => $request->bio,
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([

            'status' => true,
            'data' => "data Inserted successfully",
            'token'  => $token,
            'user'   => $user   
        ]);
    }


    public function login(Request $request){
        

    }

}
