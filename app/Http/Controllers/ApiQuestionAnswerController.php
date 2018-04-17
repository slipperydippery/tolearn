<?php

namespace App\Http\Controllers;

use Auth;
use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class ApiQuestionAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('questionowner')->only('store', 'index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return $question->answers;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        if( ! $question->scorecards->where('user_id', Auth::user()->id)){
            Scorecard::create([
                'user_id' => Auth::user()->id,
                'question_id' => $question->id,
                'moving_average' => 1,
            ]);
        }
        $scorecard = $question->scorecards->where('user_id', Auth::user()->id)->first();

        $answer = Answer::create([
            'correct' => $request->answer,
            'user_id' => Auth::user()->id,
            'question_id' => $question->id,
            'scorecard_id' => $scorecard->id,
        ]);

       return $answer;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
