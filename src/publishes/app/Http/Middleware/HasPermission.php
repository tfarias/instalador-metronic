<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

class HasPermission
{

    /**
     * Trata o request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     * @throws UnauthorizedAccessException
     */
    public function handle($request, Closure $next)
    {
        if(!session()->get('super_admin')) {
            $routeName = $request->route()->getName();
            if (strpos($routeName, '.post') == false && $request->method() == 'GET' && $routeName !== 'nao_autorizado') {
                if (Gate::denies($routeName)) {
                    return redirect()->route('nao_autorizado');
                }
            }
        }

        return $next($request);
    }
}
