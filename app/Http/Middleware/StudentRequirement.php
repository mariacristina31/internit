<?php

namespace App\Http\Middleware;

use Closure;

class StudentRequirement
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
        if (auth()->user()->is_verified == false) {
            return redirect()->route('requirements.information');
        }
        return $next($request);
    }
}
