<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;




class UserController extends Controller
{
    public function index(Request $request)
{
    // ❗ IMPORTANT — ADMIN KO DB LEVEL PE HATAO
    $query = User::where('role', '!=', 'admin');

    // Search
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', "%{$request->search}%")
              ->orWhere('email', 'like', "%{$request->search}%");
        });
    }

    // Department filter
    if ($request->department) {
        $query->whereJsonContains('department', $request->department);
    }

    $users = $query->latest()->paginate(4)->withQueryString();

    return view('dashboard', compact('users'));
}

        

    
    public function create()
    {
        return view('admin.create-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:6',
            'dob'         => 'required|date',
            'experience'  => 'required|integer|min:0|max:50',
            'department'   => 'required|array',
            'department.*' => 'in:Engineering,Design,Marketing',
            'skill_level' => 'required|integer|min:1|max:10',
            'shift'       => 'required|in:day,night',
            'theme_color' => 'required|string',
            'bio'         => 'required|string|max:1000',
            'role'        => 'nullable|in:user,admin',
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);
    
            $imagePaths = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
            
                    // original file name
                    $filename = $file->getClientOriginalName();
            
                    // agar same naam already exist kare to rename na ho isliye unique suffix
                    $path = 'users/'.$filename;
                    $counter = 1;
            
                    while (Storage::disk('public')->exists($path)) {
                        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                                    .'_'.$counter.'.'
                                    .$file->getClientOriginalExtension();
            
                        $path = 'users/'.$filename;
                        $counter++;
                    }
            
                    $file->storeAs('users', $filename, 'public');
                    $imagePaths[] = $path;
                }
            }

        User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'experience'  => $request->experience,
            'department' => $request->department,
            'skill_level' => $request->skill_level,
            'shift'       => $request->shift,
            'theme_color' => $request->theme_color,
            'bio'         => $request->bio,
            'dob'         => $request->dob,
            'newsletter'  => $request->has('newsletter'),
            'role'        => $request->role ?? 'user',
            'images'      => $imagePaths,
        ]);
    
        return redirect()->route('dashboard')->with('success','User Created');
    }
    
    
    
    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }
    public function update(Request $req, $id)
    {
        $user = User::findOrFail($id);
    
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'experience' => 'required|integer|min:0|max:50',
            'department' => 'required|array',
            'skill_level' => 'required|integer|min:1|max:10',
            'shift' => 'required|in:day,night',
            'theme_color' => 'required|string',
            'bio' => 'required|string|max:1000',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240'
        ]);
    
        // ✅ STEP 1 — Purani images load karo
        $existingImages = [];
        if (!empty($user->images)) {
            $existingImages = is_array($user->images)
                ? $user->images
                : (json_decode($user->images, true) ?? []);
        }
    
        // ✅ STEP 2 — Sirf selected images delete karo
        if ($req->delete_images) {
            foreach ($req->delete_images as $img) {
                Storage::disk('public')->delete($img);
                $existingImages = array_diff($existingImages, [$img]);
            }
        }
    
        // ✅ STEP 3 — New images add karo (old ke saath merge)
        if ($req->hasFile('images')) {
            foreach ($req->file('images') as $file) {
    
                $filename = $file->getClientOriginalName();
                $path = 'users/'.$filename;
                $counter = 1;
    
                while (Storage::disk('public')->exists($path)) {
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                                .'_'.$counter.'.'
                                .$file->getClientOriginalExtension();
    
                    $path = 'users/'.$filename;
                    $counter++;
                }
    
                $file->storeAs('users', $filename, 'public');
    
                // 🔥 merge karo, replace nahi
                $existingImages[] = $path;
            }
        }
    
        // ✅ STEP 4 — Save everything
        $user->update([
            'name' => $req->name,
            'email' => $req->email,
            'experience' => $req->experience,
            'department' => $req->department,
            'skill_level' => $req->skill_level,
            'shift' => $req->shift,
            'theme_color' => $req->theme_color,
            'bio' => $req->bio,
            'newsletter' => $req->has('newsletter'),
            'dob' => $req->dob,
            'images' => array_values($existingImages), // 🧠 old + new both
            'password' => $req->password ? Hash::make($req->password) : $user->password,
        ]);
    
        return redirect()->route('users.index')->with('success','User Updated');
    }
    
    
    
    

public function destroy($id)
{
    $user = User::findOrFail($id);

    // 🧠 Make sure images are always array
    $images = is_array($user->images)
        ? $user->images
        : (json_decode($user->images, true) ?? []);

    // 🗑 Delete images from storage
    foreach ($images as $img) {
        if ($img && Storage::disk('public')->exists($img)) {
            Storage::disk('public')->delete($img);
        }
    }

    $user->delete();

    return redirect()->route('dashboard')->with('success', 'User deleted successfully');
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
