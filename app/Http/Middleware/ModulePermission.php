<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ModulePermission
{

    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->subscription->planPrice->plan->modules->where()->exists()) {
            return $next($request);
        }

        return response('Seu plano não possui acesso a este módulo', 403);
    }

}
