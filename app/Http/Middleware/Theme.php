<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class Theme
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        $theme = 'light';
        $density = 'comfortable';

        if ($user && $user->setting) {
            $theme = $user->setting->theme_style ?? 'light';
            $density = $user->setting->density ?? 'comfortable';
        }

        View::share('theme', $theme);
        View::share('density', $density);

        return $next($request);
    }
}
