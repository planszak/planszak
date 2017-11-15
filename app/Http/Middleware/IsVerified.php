<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Jrean\UserVerification\Middleware\IsVerified as Verified;

class IsVerified extends Verified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!is_null($request->user()) && !$request->user()->verified) {
            Auth::logout();
            return redirect('login')->with('warning', trans('user-verification.verification_pending_message'));
        }

        return $next($request);
    }
}
