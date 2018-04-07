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

Route::post('/api/question/{question}/update', 'ApiQuestionController@update');
Route::get('/api/tag', 'ApiTagController@index');
Route::get('/api/question/{question}/tag', 'ApiQuestionTagController@index');
Route::post('/api/question/{question}/tag/store', 'ApiQuestionTagController@store');
Route::get('/api/question/{question}/tag/{tag}/destroy', 'ApiQuestionTagController@destroy');

