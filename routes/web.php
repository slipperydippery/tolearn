<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('question', 'QuestionController');

Route::get('/question/{question}/followup/storefollowup', 'QuestionFollowupController@storefollowup')->name('question.followup.storefollowup');
Route::get('/question/{question}/followup/storeparent', 'QuestionFollowupController@storeparent')->name('question.followup.storeparent');

Route::post('/api/question/{question}/update', 'ApiQuestionController@update');
Route::post('/api/question/store', 'ApiQuestionController@store');

Route::get('/api/tag', 'ApiTagController@index');
Route::get('/api/question/{question}/tag', 'ApiQuestionTagController@index');
Route::post('/api/question/{question}/tag/store', 'ApiQuestionTagController@store');
Route::get('/api/question/{question}/tag/{tag}/destroy', 'ApiQuestionTagController@destroy');

Route::post('/api/hint/{hint}/update', 'ApiHintController@update');
Route::get('/api/hint/{hint}/destroy', 'ApiHintController@destroy');
Route::get('/api/question/{question}/hint', 'ApiQuestionHintController@index');
Route::post('/api/question/{question}/hint/store', 'ApiQuestionHintController@store');

Route::get('/api/scorecard/{scorecard}', 'ApiScorecardController@show');
Route::post('/api/scorecard/{scorecard}/update', 'ApiScorecardController@update');
Route::get('/api/scorecard/{scorecard}/answer', 'ApiScorecardAnswerController@index');
Route::post('/api/question/{question}/answer/store', 'ApiQuestionAnswerController@store');

Route::get('/questionset/create', 'QuestionsetController@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
