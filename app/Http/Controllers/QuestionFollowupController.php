<?php

namespace App\Http\Controllers;

use Auth;
use App\Question;
use Illuminate\Http\Request;

class QuestionFollowupController extends Controller
{
    public function storefollowup(Question $question)
    {
        $followup = Question::create([
            'user_id' => Auth::user()->id
        ]);

        $question->followup()->save($followup);

        $question = $followup;
    	return view('question.edit', compact('question'));
    }

    public function storeparent(Question $question)
    {
        $parent = Question::create([
            'user_id' => Auth::user()->id
        ]);

        $parent->followup()->save($question);

        $question = $parent;
        return view('question.edit', compact('question'));
    }
}
