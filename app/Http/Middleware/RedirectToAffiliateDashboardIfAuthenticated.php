<?php

namespace App\Http\Middleware;

use App\Enums\UserRoleType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectToAffiliateDashboardIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->role_type == UserRoleType::AFFILIATE) {
            return redirect(route('affiliate.dashboard'));
        } else if($request->user()) {
            Auth::logout();
        }
        return $next($request);
    }
}
