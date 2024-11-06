<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login logic
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    // Example dashboard route
    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect()->route('login')->with('error', 'Please login first.');
    }

    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle registration logic
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Generate a unique ID manually
    $lastUser = User::orderBy('id', 'desc')->first();
    $newId = $lastUser ? $lastUser->id + 1 : 1;

    // Set default role 'customer' jika role tidak ada di request
    $role = $request->input('role', 'customer'); // Jika role tidak ada, otomatis 'customer'
    $user = User::create([
        'id' => $newId, // Manually assign the new ID
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $role,
    ]);

    Auth::login($user);

    return redirect()->intended('dashboard');
}



    // Handle logout logic
    public function logout(Request $request)
{
    Auth::logout();
    return view('welcome')->with('success', 'Successfully logged out!');
}

// Show reset password form
public function showResetPasswordForm()
{
    return view('auth.reset-password');
}

// Handle password update
public function updatePassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email address not found.']);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->route('login')->with('success', 'Password successfully updated!');
}


}


