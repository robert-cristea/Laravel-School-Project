<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

 Route::middleware('auth:api')->get('/user', function (Request $request) {
     return $request->user();
 });

Route::group([
    'namespace'=>'\App\Http\Controllers\Api',
],function (){
    Route::get('questions','QuestionController@getAllQuestions')->name('common.questions.all.api');
    Route::post('questions','QuestionController@createQuestion')->name('common.questions.create.api');
    Route::get('questions/{id}','QuestionController@getQuestion')->name('common.questions.getOne.api');
    Route::put('questions/{id}','QuestionController@updateQuestion')->name('common.questions.update.api');
    Route::delete('questions/{id}','QuestionController@deleteQuestion')->name('common.questions.delete.api');

});

