<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class ApiQuestionsetController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $questionset = [];
        //  for now all questions, later this will be a truncated list based on tags, difficulty, etc of the user. 
        foreach ( Question::get() as $question ) {
            $weight = 3;
            //  Later weighting based on most recent questions will also be added. 
            if (Auth::user()->scorecards->where('question_id', $question->id)) {
                $weight = Auth::user()->scorecards->where('question_id', $question->id)->first()->weight;
                // maybe this should generate a scorecard automatically if it doesn't exist. 
            }
            for ($x = 0; $x <= $weight; $x++) {
                $questionset[$question];
            } 
        }
        return shuffle($questionset);
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
