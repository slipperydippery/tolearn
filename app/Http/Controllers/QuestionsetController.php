<?php

namespace App\Http\Controllers;

use Auth;
use App\Question;
use App\Questionset;
use Illuminate\Http\Request;

class QuestionsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questionset = [];
        //  for now all questions, later this will be a truncated list based on tags, difficulty, etc of the user. 
        foreach ( Question::get() as $question ) {
            $weight = 3;
            //  Later weighting based on most recent questions will also be added. 
            if (Auth::user()->scorecards->where('question_id', $question->id)->count()) {
                $weight = Auth::user()->scorecards->where('question_id', $question->id)->first()->weight;
            }
            for ($x = 0; $x <= $weight; $x++) {
                $questionset[] = $question;
            } 
        }
        shuffle($questionset);
        return $questionset;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Questionset  $questionset
     * @return \Illuminate\Http\Response
     */
    public function show(Questionset $questionset)
    {
        return view('questionset.show', compact($questionset));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Questionset  $questionset
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionset $questionset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Questionset  $questionset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionset $questionset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Questionset  $questionset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionset $questionset)
    {
        //
    }
}
