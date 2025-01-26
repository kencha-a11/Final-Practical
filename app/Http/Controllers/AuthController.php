<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\Generator\StringManipulation\Pass\Pass;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }
    public function registerForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $existingUser = User::where('email', $validated['email'])->first();
        if ($existingUser) {
            return redirect()->back()->withErrors(['email' => 'This email is already registered. Please login or use a different email.']);
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Registration successful. Please log in.');
    }


    public function login(){
        return view('auth.login');
    }
    public function loginForm(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $request->remember)) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

   public function dashboard(){
        $posts = Post::where('user_id', Auth::id())->get();
        return view('auth.dashboard', compact('posts'));
   }

   public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session to ensure all session data is cleared
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation attacks
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
