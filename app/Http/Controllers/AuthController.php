<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function showRegister(): View|Application|Factory
    {
        return view('auth.register');
    }

    public function showLogin(): View|Application|Factory
    {
        return view('auth.login');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'login' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|email|',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::query()->create($validated);
        auth()->login($user);

        return redirect()->route('media.index');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/media');
        }

        return back()->with('error', __('The provided credentials do not match our records.'));
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
