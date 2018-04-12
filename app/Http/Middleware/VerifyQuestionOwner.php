<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Question;

class VerifyQuestionOwner
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
        $questionid = $request->route('question')->id;
        $question = Question::findOrFail($questionid);
        if(Auth::user()->id != $question->user->id) {
            return response("You don't have permission to modify this question", 401);
        }
        return $next($request);
    }
}
