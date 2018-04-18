<?php

use App\Answertype;
use Illuminate\Database\Seeder;

class AnswertypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$answertype_self = new Answertype();
    	$answertype_self->name = 'Self';
    	$answertype_self->description = 'Let the user judge the validity of the answer themself';
    	$answertype_self->save();

    	$answertype_multiplechoice = new Answertype();
    	$answertype_multiplechoice->name = 'Multiple choice';
    	$answertype_multiplechoice->description = 'provide multiple possible answers with one correct one for the user to chose from';
    	$answertype_multiplechoice->save();

    	$answertype_code = new Answertype();
    	$answertype_code->name = 'Code';
    	$answertype_code->description = 'Allow the user to code in the required language in an attempt to reach the desired result.';
    	$answertype_code->save();
    }
}
