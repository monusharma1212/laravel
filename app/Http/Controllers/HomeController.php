<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;   // ✅ model import

class HomeController extends Controller
{
    public function dashboard()
{
    $users = auth()->user()->role === 'admin'
                ? User::where('role', '!=', 'admin')->latest()->paginate(10)
                : collect();

    return view('dashboard', compact('users'));
}

}
