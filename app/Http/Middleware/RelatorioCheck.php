<?php

namespace App\Http\Middleware;

use Closure;

class RelatorioCheck
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
        dd($request);
        if ( $request->id() != auth()->user()->id) {
            return abort('403', 'ACESSO NÃO PERMITIDO');
        }
        return $next($request);
    }
}
