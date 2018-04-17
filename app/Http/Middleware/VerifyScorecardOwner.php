<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Scorecard;

class VerifyScorecardOwner
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
        $scorecardid = $request->route('scorecard')->id;
        $scorecard = Scorecard::find($scorecardid); 
        if(Auth::user()->id != $scorecard->user->id) {
            return response("You don't have permission to access this scorecard", 401);
        }
        return $next($request);
    }
}
