<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login Page
    public function showLogin() {
        return view('auth.login');
    }

    // Register Page
    public function showRegister() {
        return view('auth.register');
    }

    // Register Logic
    public function register(Request $req) {

        $req->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'resume'=>'nullable|mimes:pdf|max:2048',
            'experience'=>'nullable|min:0|max:120',
        ]);

        // 👇 First user admin banega
        $role = User::count() == 0 ? 'admin' : 'user';

        if($req->hasFile('resume')){
            $resumePath = $req->file('resume')->store('resumes','public');
        }

        $user = User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
            'dob'=>$req->birth_date,
            'experience'=>$req->experience,
            'department'=>$req->department,
            'resume'=>$resumePath,  
            'theme_color'=>$req->color,
            'skill_level'=>$req->skill_level,
            'shift'=>$req->shift,
            'newsletter'=>$req->newsletter ?? 0,
            'bio'=>$req->bio,
            'role'=>$role
        ]);

        Auth::login($user); // ⭐ login kara diya

        return $user->role == 'admin'
        ? redirect('/users')
        : redirect('/dashboard');
    }

    // Login Logic
   
    public function login(Request $req)
    {
        // Validation
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt login (DB se match karega)
        if (Auth::attempt([
            'email' => $req->email,
            'password' => $req->password
        ])) {

        // Session regenerate (security)
        $req->session()->regenerate();

        // Role based redirect
        if (Auth::user()->role == 'admin') {
            return redirect('/users');   // admin dashboard
        } else {
            return redirect('/'); // normal user page
        }
    }

    return back()->with('error', 'Invalid Email or Password');
}

    public function logout(Request $request)
    {
        Auth::logout(); // user logout

        $request->session()->invalidate();      // session destroy
        $request->session()->regenerateToken(); // CSRF token refresh

        return redirect('/');
    }
}
