<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckResult
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('pending_result')) {
            return redirect()->route('input.calibration.data');
        }

        return $next($request);
    }
}
