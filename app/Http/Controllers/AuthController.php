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
    public function register(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:6',
        
            'birth_date'  => 'required',   // no strict date rule
            'experience'  => 'required|numeric',
            'department'   => 'required|array',
            'department.*' => 'in:Engineering,Design,Marketing',

        
            'images'      => 'required',
            'images.*'    => 'required|image|mimes:jpg,jpeg,png,webp|max:20280',
        
            'color'       => 'required|string',
            'skill_level' => 'required|numeric',
        
            'shift'       => 'required|in:day,night',
            'bio'         => 'required|string',
        ]);
    
        // Image Upload
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $imagePaths[] = $img->store('users','public');
            }
        }
    
        // Store user
        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'dob'         => $request->birth_date,
            'experience'  => $request->experience,
            'department' => json_encode($request->department),
            'images'      => json_encode($imagePaths),
            'theme_color' => $request->color,
            'skill_level' => $request->skill_level,
            'shift'       => $request->shift,
            'newsletter'  => $request->newsletter ?? 0,
            'bio'         => $request->bio,
        ]);
        Auth::login($user);
        return redirect()->route('dashboard')->with('success','Registration Successful!');
    }
    

    // Login Logic
   

    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $req->email,
            'password' => $req->password
        ])) {

            $req->session()->regenerate();

            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        }

        // ❌ If login fails
        return back()->withErrors([
            'email' => 'Invalid email or password'
        ])->withInput();
    


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
