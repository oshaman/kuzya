<?php

namespace App\Http\Middleware;

use App\Models\Technical;
use Closure;

class Tech
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
        $tech = Technical::getTech();

        if ($tech) {
            return redirect()->route('tech');
        }

        return $next($request);
    }
}
