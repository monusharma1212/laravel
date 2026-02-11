<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;   // ✅ model import

class ProfileController extends Controller
{
    public function dashboard()
    {
        $users = auth()->user()->role === 'admin'
                    ? User::where('role', '!=', 'admin')->latest()->paginate(4)->withQueryString()
                    : collect();

        return view('dashboard', compact('users'));
    }


    public function profile()
    {
        $data = Auth::user();

        $users = $data->role === 'admin'
            ? \App\Models\User::where('role','!=','admin')->latest()->paginate(10)
            : collect();

        return view('users.index', compact('data','users'));
    }

    public function profilEdit()
    {
        $data = auth()->user();   // 👈 single user object
        return view('users.profile-edit', compact('data'));
    }




    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        // ✅ VALIDATION
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => ['required','email', Rule::unique('users')->ignore($user->id)],
            'experience'  => 'required|integer|min:0|max:50',

            'department'      => 'required|array|min:1',
            'department.*'    => 'string',

            'skill_level' => 'required|integer|min:1|max:10',
            'shift'       => 'required|in:day,night',
            'theme_color' => 'required|string',
            'bio'         => 'nullable|string|max:500',

            'password' => 'nullable|min:6|confirmed',

            'images'   => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',

            'delete_images'   => 'nullable|array',
            'delete_images.*' => 'string',
        ]);

        // 🧠 Load existing images
        $existingImages = is_array($user->images)
            ? $user->images
            : (json_decode($user->images, true) ?? []);

        // ❌ Delete selected images
        if ($request->delete_images) {
            foreach ($request->delete_images as $img) {
                if (in_array($img, $existingImages)) {
                    Storage::disk('public')->delete($img);
                    $existingImages = array_diff($existingImages, [$img]);
                }
            }
        }

        // ➕ Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('users', 'public');
                $existingImages[] = $path;
            }
        }

        // 🔑 Update user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'experience' => $request->experience,
            'department' => json_encode($request->department),
            'skill_level' => $request->skill_level,
            'shift' => $request->shift,
            'theme_color' => $request->theme_color,
            'bio' => $request->bio,
            'images' => array_values($existingImages),
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('profile')->with('success','Profile updated successfully');
    }



}
