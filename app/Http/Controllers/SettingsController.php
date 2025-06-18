<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index(): View|Application|Factory
    {
        $user = Auth::user();
        $setting = $user->setting;

        $theme = $setting?->theme_style ?? 'light';
        $density = $setting?->density ?? 'comfortable';

        return view('settings', compact('theme', 'density'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'theme' => ['required', 'in:light,dark'],
            'density' => ['required', 'in:comfortable,compact']
        ]);

        $user = Auth::user();

        $setting = Setting::firstOrCreate(
            ['user_login' => $user->login],
            ['theme_style' => 'light'],
            ['density' => 'comfortable']
        );

        $setting->update([
            'theme_style' => $request->input('theme'),
            'density' => $request->input('density'),
        ]);

        return redirect()->back()->with('status', __('Settings updated successfully.'));
    }
}
