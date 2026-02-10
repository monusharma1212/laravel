<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function index(Request $request)
{
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
        $query->where('department', $request->department);
    }

    // Sorting
    $sort = $request->get('sort', 'id');       // default column
    $direction = $request->get('direction', 'asc'); // asc or desc

    $allowed = ['name','email','department','experience','skill_level','dob'];
    if (!in_array($sort, $allowed)) {
        $sort = 'id';
    }

    $users = $query->orderBy($sort, $direction)->paginate(5)->withQueryString();

    return view('admin.users', compact('users'));
}

    
    public function create()
    {
        return view('admin.create-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240'
        ]);
    
        $imagePaths = [];
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $imagePaths[] = $img->store('users', 'public');
            }
        }
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'experience' => $request->experience,
            'department' => $request->department,
            'skill_level' => $request->skill_level,
            'shift' => $request->shift,
            'theme_color' => $request->theme_color,
            'bio' => $request->bio,
            'dob' => $request->dob,
            'newsletter' => $request->has('newsletter'),
            'role' => $request->role ?? 'user',
            'images' => $imagePaths,
        ]);
        
        return redirect()->route('users.index')->with('success','User Created');
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
            'email' => 'required|email|unique:users,email,'.$user->id,
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20280'
        ]);
        
        $existingImages = $user->images ?? [];
        
        // Delete selected
        if ($req->delete_images) {
            foreach ($req->delete_images as $img) {
                Storage::disk('public')->delete($img);
                $existingImages = array_diff($existingImages, [$img]);
            }
        }
        
        // Add new
        if ($req->hasFile('images')) {
            foreach ($req->file('images') as $file) {
                $existingImages[] = $file->store('users', 'public');
            }
        }
        
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
            'role' => $req->role,
            'images' => array_values($existingImages),
            'password' => $req->password ? Hash::make($req->password) : $user->password,
        ]);
        
        return redirect()->route('users.index')->with('success','User Updated');
    }
    


    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success','User Deleted');
        dd(auth()->user());
    }

    public function profile()
    {
        $data = Auth::user();   // Direct database se ek hi user
        return view('users.index', compact('data'));
    }
}
