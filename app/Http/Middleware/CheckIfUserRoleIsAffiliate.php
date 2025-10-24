<?php

namespace App\Http\Middleware;

use App\Enums\UserRoleType;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfUserRoleIsAffiliate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect(route('affiliate.login'));
        }
        if ($request->user()->type != UserRoleType::AFFILIATE) {
            abort(403, __('Access denied'));
        }
        return $next($request);
    }
}
