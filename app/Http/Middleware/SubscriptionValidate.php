<?php

namespace App\Http\Middleware;

use App\Subscription\SubscriptionStatus;
use Closure;
use Illuminate\Http\Request;

class SubscriptionValidate
{

    public function handle(Request $request, Closure $next)
    {
        if (SubscriptionStatus::subscription(auth()->user()->subscription)->isActive()) {
            return $next($request);
        }

        return response('Assinatura inválida', 403);
    }

}
