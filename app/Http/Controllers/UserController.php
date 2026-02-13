<?php
namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                $q
                    ->where('name', 'like', "%{$request->search}%")
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

<<<<<<< HEAD
    // Department filter
    if ($request->department) {
        $query->whereJsonContains('department', $request->department);
    }

    $users = $query->latest()->paginate(4)->withQueryString();

    return view('dashboard', compact('users'));
}




=======
>>>>>>> 174c52b (custome_validation message)
    public function create()
    {
        return view('admin.create-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'dob' => 'required|date',
            'experience' => 'required|integer|min:0|max:50',
            'department' => 'required|array',
            'department.*' => 'in:Engineering,Design,Marketing',
            'skill_level' => 'required|integer|min:1|max:10',
            'shift' => 'required|in:day,night',
            'theme_color' => 'required|string',
            'bio' => 'required|string|max:1000',
            'role' => 'nullable|in:user,admin',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);
<<<<<<< HEAD

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
=======

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // original file name
                $filename = $file->getClientOriginalName();

                // agar same naam already exist kare to rename na ho isliye unique suffix
                $path = 'users/' . $filename;
                $counter = 1;

                while (Storage::disk('public')->exists($path)) {
                    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                        . '_' . $counter . '.'
                        . $file->getClientOriginalExtension();

                    $path = 'users/' . $filename;
                    $counter++;
>>>>>>> 174c52b (custome_validation message)
                }

                $file->storeAs('users', $filename, 'public');
                $imagePaths[] = $path;
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

<<<<<<< HEAD
        return redirect()->route('dashboard')->with('success','User Created');
    }




=======
        return redirect()->route('dashboard')->with('success', 'User Created');
    }

>>>>>>> 174c52b (custome_validation message)
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
            'email' => 'required|email|unique:users,email,' . $user->id,
            'experience' => 'required|integer|min:0|max:50',
            'department' => 'required|array',
            'skill_level' => 'required|integer|min:1|max:10',
            'shift' => 'required|in:day,night',
            'theme_color' => 'required|string',
            'bio' => 'required|string|max:1000',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240'
<<<<<<< HEAD
        ]);
=======
        ],
            [
                'email.unique' => 'This Email is already Taken Custome Message'
            ]);
>>>>>>> 174c52b (custome_validation message)

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
<<<<<<< HEAD

=======
>>>>>>> 174c52b (custome_validation message)
                $filename = $file->getClientOriginalName();
                $path = 'users/' . $filename;
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
            'images' => array_values($existingImages),  // 🧠 old + new both
            'password' => $req->password ? Hash::make($req->password) : $user->password,
        ]);
<<<<<<< HEAD

        return redirect()->route('users.index')->with('success','User Updated');
    }




=======
>>>>>>> 174c52b (custome_validation message)

        return redirect()->route('users.index')->with('success', 'User Updated');
    }

<<<<<<< HEAD
    $user->delete();

    return redirect()->route('dashboard')->with('success', 'User deleted successfully');
}


=======
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

    public function exportCsv()
    {
        $users = User::all();

        $filename = 'users.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate',
            'Expires' => '0'
        ];

        $columns = ['Name', 'Email', 'Department', 'Experience', 'Skill', 'Shift', 'DOB', 'Role'];

        $callback = function () use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->name,
                    $user->email,
                    is_array($user->department) ? implode(', ', $user->department) : $user->department,
                    $user->experience,
                    $user->skill_level,
                    $user->shift,
                    $user->dob,
                    $user->role
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
>>>>>>> 174c52b (custome_validation message)


    public function exportPdf()
    {
        $users = User::all();

        $pdf = Pdf::loadView('users.pdf', compact('users'))->setPaper('a4', 'landscape'); // 👈 yaha change

        return $pdf->download('users.pdf');
    }
}
