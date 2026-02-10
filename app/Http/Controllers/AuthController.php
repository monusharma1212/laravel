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
    public function register(Request $req)
    {

        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480',
            'experience' => 'nullable|min:0|max:120',
        ]);
    
        $role = User::count() == 0 ? 'admin' : 'user';
    
        $imagePaths = [];
    
        if ($req->hasFile('images')) {
            foreach ($req->file('images') as $img) {
                $imagePaths[] = $img->store('users', 'public');
            }
        }
    
        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'dob' => $req->birth_date,
            'experience' => $req->experience,
            'department' => $req->department,
            'images' => $imagePaths,  // 👈 multiple files
            'theme_color' => $req->color,
            'skill_level' => $req->skill_level,
            'shift' => $req->shift,
            'newsletter' => $req->newsletter ?? 0,
            'bio' => $req->bio,
            'role' => $role
        ]);
    
        Auth::login($user);
    
        return $user->role == 'admin'
            ? redirect('/dashboard')
            : redirect('/dashboard');
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
