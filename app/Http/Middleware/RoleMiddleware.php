<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/seeker_login');
        }

        // role tidak sesuai → blokir
        if (Auth::user()->role !== $role) {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }

        return $next($request);
    }
}

