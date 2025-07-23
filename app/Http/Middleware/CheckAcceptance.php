<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAcceptance
{
    public function handle(Request $request, Closure $next)
    {
        // Jika ada flag pending_acceptance, kirim ke dashboard agar modal muncul
        if (session()->has('pending_acceptance')) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
