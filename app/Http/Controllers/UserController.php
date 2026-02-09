<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
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
            'password' => 'required|min:4',
            'resume' => 'nullable|mimes:pdf|max:2048'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['newsletter'] = $request->has('newsletter');

        if($request->hasFile('resume')){
            $data['resume'] = $request->file('resume')->store('resumes','public');
        }

        User::create($data);

        return redirect()->route('users.index')->with('success','User Created');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'resume' => 'nullable|mimes:pdf|max:2048'
        ]);

        $data = $request->except('resume','password');
        $data['newsletter'] = $request->has('newsletter');

        // Password update only if entered
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Resume update + old delete
        if ($request->hasFile('resume')) {

            if ($user->resume && Storage::disk('public')->exists($user->resume)) {
                Storage::disk('public')->delete($user->resume);
            }

            $data['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User Updated Successfully');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success','User Deleted');
        dd(auth()->user());
    }
}
