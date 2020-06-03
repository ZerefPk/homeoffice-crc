<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdm
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
        
        if (auth()->user()->admin == 0) {
            return abort('403', 'ACESSO NÃO PERMITIDO');
        }

        return $next($request);
    }
}
