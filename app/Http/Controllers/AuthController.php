<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegister(){
        return view('auth.register');
    }
    public function showLogin(){
        return view('auth.login');
    }
    public function register(Request $request){
        $validated = $request->validate([
            'login' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|email|',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create($validated);

        auth()->login($user);

        return redirect()->route('media.index');

    }
    public function login(Request $request){
        $credentials = $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required',
        ]);
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/media');
        }
        return back()->with('error', 'The provided credentials do not match our records.');
    }
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
