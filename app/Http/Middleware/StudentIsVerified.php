<?php

namespace App\Http\Middleware;

use Closure;

class StudentIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->is_verified == true) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
