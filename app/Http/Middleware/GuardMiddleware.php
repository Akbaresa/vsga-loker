<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuardMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $guard): Response
    {
        $user = Auth::guard($guard)->user();
        if (!$user) {
            return redirect()->route("karyawan.login");
        }
        
        // $prefix = $request->segment(1);
        // dd($prefix);

        // if ($prefix !== $guard) {
        //     Auth::guard($guard)->logout();
        //     return redirect()->route("karyawan.login");
        // }

        if ($request->is("$guard/login")) {
            return redirect()->route("karyawan.dashboard");
        }

        return $next($request);
    }
}
