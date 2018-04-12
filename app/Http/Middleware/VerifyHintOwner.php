<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Hint;

class VerifyHintOwner
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
        $hintid = $request->route('hint')->id;
        $hint = Hint::find($hintid);
        if(Auth::user()->id != $hint->question->user->id){
            return response("You don't have permission to modify this hint", 401);
        }
        return $next($request);
    }
}
