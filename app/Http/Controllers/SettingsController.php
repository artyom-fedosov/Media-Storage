<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $theme = Auth::user()?->theme_style ?? 'light';
        $density = Auth::user()?->density ?? 'comfortable';
        return view('settings', compact('theme', 'density'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'theme' => ['required', 'in:light,dark'],
            'density' => ['required', 'in:comfortable,compact'],
        ]);

        $user = Auth::user();
        $user->theme_style = $request->input('theme');
        $user->density = $request->input('density');
        $user->save();

        return redirect()->back()->with('status', __('Settings updated successfully.'));
    }
}
