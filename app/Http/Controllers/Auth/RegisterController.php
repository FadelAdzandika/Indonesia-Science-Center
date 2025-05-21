<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name'                  => ['required', 'string', 'max:255'],
        'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password'              => ['required', 'string', 'min:6', 'confirmed'],
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        // 'role' => 'user', // ini default, boleh diisi atau tidak
    ]);

    Auth::login($user);

    // Redirect sesuai role
    if ($user->role == 'admin') {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/'); // atau ke halaman lain untuk user biasa
    }
}

}